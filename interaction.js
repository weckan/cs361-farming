function signup(user,pass) {
    var req = new XMLHttpRequest();
    if ( !req ) {
        throw 'Unable to create HttpRequest.';
    }
    var url = 'http://web.engr.oregonstate.edu/~ratlifri/farming/signup.php';
    var parms = {
	    usr: user,
	    psw: pass
	};
    req.onreadystatechange = function() {
        if ( this.readyState === 4 && this.status === 200 ) {
            document.getElementById("resultFooter").innerHTML = this.responseText;
        }
    }
    req.open('POST', url);
	req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    req.send( urlStringify(parms) );
}

function urlStringify(obj) {
    var str = []
    for (var prop in obj) {
        var s = encodeURIComponent(prop) + '=' + encodeURIComponent(obj[prop]);
        str.push(s);
    }
    return str.join('&');
}

function loadLogin() {
    window.location.href = 
      'http://web.engr.oregonstate.edu/~ratlifri/farming/login.html';
}

function login(user,pass) {
    var req = new XMLHttpRequest();
    if ( !req ) {
        throw 'Unable to create HttpRequest.';
    }
    var url = 'http://web.engr.oregonstate.edu/~ratlifri/farming/login.php';
    var parms = {
	    usr: user,
	    psw: pass
	};
    req.onreadystatechange = function() {
        if ( this.readyState === 4 && this.status === 200 ) {
            document.getElementById("resultFooter").innerHTML = this.responseText;
        }
    }
    req.open('POST', url);
	req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    req.send( urlStringify(parms) );
}

function loadSite() {
    window.location.href = 
        'http://web.engr.oregonstate.edu/~ratlifri/farming/main.php';
/*      'http://web.engr.oregonstate.edu/~ratlifri/farming/debug.php'; */
}

function loadHome() {
    window.location.href = 
        'http://web.engr.oregonstate.edu/~ratlifri/farming/index.html';
}

function loadPlantList(user) {
    var req = new XMLHttpRequest();
    if ( !req ) {
        throw 'Unable to create HttpRequest.';
    }
    var url = 'http://web.engr.oregonstate.edu/~ratlifri/farming/loadPlantList.php';
    var parms = {
	    usr: user
	};
    req.onreadystatechange = function() {
        if ( this.readyState === 4 && this.status === 200 ) {
            document.getElementById("plantlist").innerHTML = this.responseText;
        }
    }
    req.open('POST', url);
	req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    req.send( urlStringify(parms) );
}

function add(name,event,date,wish,price) {
    var req = new XMLHttpRequest();
    if ( !req ) {
        throw 'Unable to create HttpRequest.';
    }
    var url = 'http://web.engr.oregonstate.edu/~ratlifri/farming/add.php';
    var parms = {
	    na: name,
	    ev: event,
	    dt: date,
        wi: wish,
        pr: price
	};
    req.onreadystatechange = function() {
        if ( this.readyState === 4 && this.status === 200 ) {
            old = document.getElementById("addRows").innerHTML;
            document.getElementById("addRows").innerHTML = old+this.responseText;
        }
    }
    req.open('POST', url);
	req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    req.send( urlStringify(parms) );
}

