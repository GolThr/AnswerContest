const userInfo = getCookie('exam_id');  //考生id信息
if (!userInfo) {
    window.location.href = 'index.html';
}
$(document).bind("contextmenu", function () { return false; });//禁止右键
document.oncontextmenu = function () { return false; };
document.onkeydown = function () {
    if (window.event && window.event.keyCode == 123) {
        event.keyCode = 0;
        event.returnValue = false;
        return false;
    }
};//禁止F12
const URLs = ['getSglSlct.php', 'getMultiSlct.php', 'getJudge.php', 'getRelated.php', 'getLogic.php', 'getQuickResponse.php']; //题目请求地址
const ShowType = ['一、单选题', '二、多选题', '三、判断题', '四、关联题', '五、逻辑题', '六、多段式'];

let problems;       //异步请求的题目数据
let problems_temp;  //存储下一模块的题目数据
let m_num = 0;      //其他模块已做题目数量
let Type;           //当前已做模块
let nowNum = 0;     //当前模块已答题数量
let maxNum;         //当前模块已接受题目数量
let allNum = 80;         //所有题目数量
let startTime;      //答题开始时间
let endTime;        //答题结束时间
let updateAns = {};   //用户所有答案
let now_Ans = {};
let Infos = {};       //提交数据
let now_problem_id = {}; // 当前题型题目id

let allAns = getCookie("Ans");
let A_Temp = JSON.parse(allAns);
for (let temp in A_Temp){
    Infos[nowNum++] = A_Temp[temp];
}
if (nowNum >= allNum){
    window.location.href='end.php';
}

// 回调函数，调用接受的题目数据
function AddProblems(pro) {
    problems = pro;
    maxNum = problems.length;
    ShowProblem();
}

// 显示当前题目信息
function ShowProblem() {
    if (Number(nowNum)+Number(m_num)+1 == allNum){
        let btn = document.getElementsByTagName("Button");
        btn[0].innerHTML = "交卷";
    }
    if (nowNum < 0) {
        window.location.href = 'end.php';
    }

    $('#Type').html(ShowType[Type]);
    let now_cnt = 0;

    let Ans = getCookie("Ans");
    if (Ans != null) {
        Ans = JSON.parse(Ans);
        let len_Ans = Object.keys(Ans).length;
        console.log("已做题目数量:" + len_Ans);
    }

    let NO = Number(m_num) + Number(nowNum) + 1; //计算当前题目标号


    $('#topic_id').html("题目" + NO + ":");
    $('#topic').html(problems[nowNum].content);
    let contents = '';
    let ans = ['A', 'B', 'C', 'D', 'E', 'F'];
    let hint = ['提示一', '提示二', '提示三', '提示四', '提示五'];
    let Cnt = 1;

    for (i in problems[nowNum]) { // 循环显示选项
        if (i === 'id'){
            now_problem_id[nowNum] = problems[nowNum][i];
            console.log("now_problem_id:");
            console.log(now_problem_id);
        } else if (i !== 'content') {
            if (Number(Type) % 2 === 0 && Number(Type) < 5) {
                contents += "<div>" + ans[now_cnt] + ".<input id='" + ans[now_cnt] + "' type='radio' name='ans' value=" + ans[now_cnt] + ">" + "<label for='" + ans[now_cnt] + "'></label><span>" + problems[nowNum][i] + "</span></div>";
            } else if (Number(Type) % 2 !== 0 && Number(Type) < 5) {
                contents += "<div>" + ans[now_cnt] + ".<input id='" + ans[now_cnt] + "' type='checkbox' name='ans' value=" + ans[now_cnt] + ">" + "<label for='" + ans[now_cnt] + "'></label><span>" + problems[nowNum][i] + "</span></div>";
            } else {    //多段式
                let T = Cnt*6000;
                Cnt++;
                contents = contents + "<p id='hint_"+i+"' style='display: none'>" + hint[now_cnt] + ":" + problems[nowNum][i] + "</p><script> setTimeout(function(){document.getElementById('hint_"+i+"').style.display='block';}, "+T+");</script>";
            }
            now_cnt = now_cnt + 1;
        }
    }

    if (Number(Type) === 5) {
        contents += "你的答案: <input type='text' name='ans'>";
        startTime = new Date().getTime();
    }
    $('#select').html(contents);

    //更新进度条
    let pg_v = document.getElementById("pg_p");
    pg_v.max = Number(allNum);
    pg_v.value = NO;
    $("#pg_b").html(NO + "/" + allNum);

    // 提前请求下一题型的题目信息
    if (nowNum == maxNum - 1 && Type < 5) {
        asynGetContents();
    }
}

// 异步请求获取题目信息
function GetContents(Num) {
    m_num = Num[0];
    nowNum -= m_num;
    let URL = URLs[Num[1]];
    // allNum = Num[2];

    $.ajax({
        url: URL,
        type: "post",
        data: {
            "exam_id": userInfo
        },
        success: function (res) {
            console.log("请求题目返回信息:");
            console.log(res);
            AddProblems(res);
        }
    })
}

//访问页面首先请求已做题数量
$.ajax({
    url: "getNum.php",
    type: "post",
    data: {
        "exam_id": userInfo
    },
    success: function (res) {
        console.log("请求题目数量返回信息:");
        console.log(res);
        Type = res[1];          //已做题目类型
        if (Type == 6) {         //答题已结束
            window.location.href = "end.php";
        }
        GetContents(res);    //已做题目数量
    }
});

// 获取cookie指定字段
function getCookie(name) {
    let arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
    arr = document.cookie.match(reg);
    if (arr)
        return unescape(arr[2]);
    else
        return null;
}

// 删除cookie指定字段
function delCookie(name) {
    let exp = new Date();
    exp.setTime(exp.getTime() - 1);
    let cval = getCookie(name);
    if (cval != null)
        document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
}

//上传答案
function UpAns() {
    allAns = getCookie("Ans");
    // 先从本地Cookie读取已做题目信息
    if (allAns) {
        updateAns = JSON.parse(allAns);
        let tempCount = 0;
        for (let key in updateAns) {
            if (key >= m_num && key <= Number(m_num) + Number(maxNum)) {
                now_Ans[tempCount] = updateAns[key];
                tempCount++;
            }
        }
    }
    console.log("当前模块已做题目记录")
    console.log(now_Ans);
    let UpUrl = ['submit.php', 'quickResponseSubmit.php'];
    if (Type != 5) {
        UpUrl = UpUrl[0];
    } else {
        UpUrl = UpUrl[1];
    }
    $.ajax({
        url: UpUrl,
        type: "POST",
        data: {
            0: {
                'exam_id': userInfo
            },
            1: now_Ans
        },
        success: function (res) {
            console.log(res);
        },
        error: function (res) {
            clearInterval(t);
            alert("答案提交失败");
            console.log(res);
        }
    });
}

// 下一题按钮
function Next() {
    endTime = new Date().getTime();
    let Time = endTime - startTime;
    console.log("做题时间:");
    console.log(Time);

    allAns = getCookie("Ans");      // 读取做过的题目信息
    console.log("Cookies:" + allAns);

    let nowAns;     //选择的答案
    let reAns;      //返回的答案
    let isNull = 1; //未做答标记
    nowAns = document.getElementsByTagName("input"); //获取选择的答案
    for (i = 0; i < nowAns.length; i++) {
        if (nowAns[i].checked) {
            if (reAns) reAns += nowAns[i].value;
            else reAns = nowAns[i].value;
            isNull = 0;
        }
    }
    if (isNull) {    //如果没有选项被选中
        reAns = 'N';
        if (Number(Type) === 5) { //多段式
            reAns = document.getElementsByTagName("input")[0].value;
            console.log(reAns);
        }
    }

    let sigAns = {
        "id": now_problem_id[nowNum],
        "type": Type,
        "answer": reAns
    };
    if (Number(Type) === 5) {
        sigAns['duration'] = Time;
    }
    Infos[Number(m_num) + Number(nowNum)] = sigAns;

    console.log(Infos);
    let ansString = JSON.stringify(Infos);

    document.cookie = "Ans=" + ansString; //做题记录写入本地Cookie

    // 更新计时器
    if (Type == 0) num = 30;
    else if (Type == 2) num = 15;
    else num = 60;
    document.cookie = "clock=" + num;

    if (nowNum < maxNum - 1) {
        nowNum = nowNum + 1;
        ShowProblem();
    } else {
        UpAns();                    //上传答案
        now_problem_id = {};    // 清空上一题型的题目信息
        now_Ans = {};
        //delCookie("clock");
        if (Number(m_num) + Number(nowNum) == allNum - 1) {
            clearInterval(t);
            alert("答题结束");
            window.location.href = "end.php";
        } else {
            problems = problems_temp;
            Type = Number(Type) + 1;
            // 更新计时器
            if (Type == 0) num = 30;
            else if (Type == 2) num = 15;
            else num = 60;
            document.cookie = "clock=" + num;
            m_num = Number(m_num) + Number(maxNum);
            nowNum = 0;
            maxNum = problems.length;
            ShowProblem();
        }
    }
}

function asynGetContents() {
    let URL = URLs[Number(Type) + 1];
    $.ajax({
        url: URL,
        type: "post",
        data: {
            "exam_id": userInfo
        },
        success: function (res) {
            console.log("asyn:");
            console.log(res);
            problems_temp = res;
        },
        error: function (res) {
            console.log(res);
        }
    })
}


// 倒计时
let t = setInterval("clock()", 1000);

let num = 30;

function clock() {
    let Cookie_time = getCookie("clock");
    if (Cookie_time == null) {
        document.cookie = "clock=" + num;
    } else {
        num = Cookie_time;
        document.cookie = "clock=" + (num - 1);
    }

    num > 0 ? num-- : Next();

    let change = document.getElementById("time");
    if (num < 10) {
        change.style = "color:red;";
    } else {
        change.style = "";
    }
    document.getElementById("time").innerText = num;
}