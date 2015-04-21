var bubbles_talent = 0;
var bubbles_company = 0;
var currentTalent = '';
var currentCompany = '';
var currentTalentMessageLength = 0;
var currentCompanyMessageLength = 0;
var intervalTalent = null;
var intervalCompany = null;

/**
 * @Param text : the bubble's message text
 * @Param type : sender(self) or receiver(rec)
 * @Param area : which area should the bubble be attached
 */
function addBubble(text, type, area) {
	if (text === '') {
		return;
	}
	
	var imgSrc = "./img/user_logo.jpg";
	var avatar_class;
	var text_class;
	if (type === 'self') {
		avatar_class = 'avatar-right';
		text_class = 'bubble-right';
	} else {
		avatar_class = 'avatar-left';
		text_class = 'bubble-left';
	}
	
	var bubble = '<div class="bubble-container"><div class="avatar ' + avatar_class + '"><img src="./img/user_logo.jpg" alt="user"/></div><div class="bubble ' + text_class + '">' + text + '</div></div>';
	
	$(area).append(bubble);

	$('.bubble-container').show(50, function showNext() {
		$(this).next('.bubble-container').show(50, showNext);
		$("#wrapper").scrollTop(9999999);
	});
	
	if (area === '#wrapper') {
		bubbles_talent++;
	} else {
		bubbles_company++;
	}
}


/**
 * @Param sender : the sender
 * @Param receiver : the receiver
 */
function retrieveMessagesForTalentTalk(sender, receiver) {
	var baseUrl = 'http://default-environment-nqhpgmhyii.elasticbeanstalk.com/';
	var php = 'Message_Talent.php';
	var	query = '?type=history&From=' + sender + '&To=' + receiver;
	var url = baseUrl + php + query;

	//console.log(currentTalentMessageLength);
	function success(data) {

		var counterValue=$('.custom_bubble').html();
		//var counterValue=0;
		if(data['read']!=1)
		{
			
    		counterValue++;
    		
		}
		//alert(counterValue);
		if(counterValue > 0)
    	{
    		//$('.custom_bubble').css("display","inline");
    		//alert("here");
    		$('.custom_bubble').text(counterValue);
    	}
		
		if (currentTalentMessageLength < data.length) {
			for (var i = currentTalentMessageLength; i < data.length; i++) {
				var type = 'rec';
				if (data[i].From_username === sender) {
					type = 'self';
				}
				addBubble(data[i].content, type, '#wrapper');
			}
		}

		if (currentTalentMessageLength < data.length) {
			currentTalentMessageLength = data.length;
		}
	}

	$.getJSON(url, success);
}
/** 
 * @Param company : the company
 * @Param student : the student
 */
function retrieveMessagesForCompanyTalk(company, student) {
	var baseUrl = 'http://default-environment-nqhpgmhyii.elasticbeanstalk.com/';
	var php = 'Messages.php';
	var query = '?type=history&company=' + company + '&student=' + student;
	var url = baseUrl + php + query;

	function success(data) {
		if (currentCompanyMessageLength < data.length) {
			for (var i = currentCompanyMessageLength; i < data.length; i++) {
				var type = 'rec';
				if (data[i].companySent === '0') {
					type = 'self';
				}
				console.log(data[i].content, type);
				addBubble(data[i].content, type, '#wrapperCompany');
			}
		}

		if (currentCompanyMessageLength < data.length) {
			currentCompanyMessageLength = data.length;
		}
	}

	$.getJSON(url, success);
}

function postMessageForTalentTalk(sender, receiver, messageSub, messageBody) {

	if (messageSub === '' || messageBody === '') {
		console.log('ERROR: messageBody or messageSub is null');
		return false;
	}

	/*alert("buzz");
	var counterValue = $('.custom_bubble').html(); // Get the current notification bubble value
	var x=$('.custom_bubble').html();
	x++;
					//$('#increase').on('click',function(){
   	counterValue++; // increment
   	alert("retreving"+x);
   	$('.custom_bubble').text(x);*/
	var baseUrl = 'http://default-environment-nqhpgmhyii.elasticbeanstalk.com/';
	var phpFile = 'Message_Talent.php';

	var url = baseUrl + phpFile;
	var message = {
		"to": receiver,
		"from": sender,
		"content": messageBody,
		"subject": messageSub
	};
	$.ajax({
		type : "POST",
		url: url,
		data: message
	});

	return true;
}

function postMessageForCompanyTalk (student, company, messageSub, messageBody) {
	var baseUrl = 'http://default-environment-nqhpgmhyii.elasticbeanstalk.com/';
	var phpFile = 'Messages.php';

	var	receiver = company;
	var	sender = student;

	var url = baseUrl + phpFile;
	var message = {
		"student": sender,
		"company": company,
		"content": messageBody,
		"subject": messageSub,
		"CompanySent": 0
	};

	$.ajax({
		type : "POST",
		url: url,
		data: message
	});
}

function removeAnimation(){
    setTimeout(function() {
        $('.custom_bubble').removeClass('animating')
    }, 1000);           
}

function getCookie(cname) {
    //var name = cname + "=";
    var ca = document.cookie.split(';')[1];
    var name=ca.split('=')[1];
    if (name.length!=0)
    {
    	return name;
    }
    /*for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }*/
    return "";
}

/*
function modify_unread(sender,counterValue)
{
	//$( "#chat-user-list" ).each(function( index ) {
	//console.log( index + ": " + $( this ).text() );
	//});	

	var listItems = $("#chat-user-list li");
	listItems.each(function(idx, li) {
    var $item = $(li);  
    var $person = $item.text();
    if(person===sender)
    {
    	if(counterValue > 0)
    	{
    		$item.children().text(counterValue+"unread messages");
    		$item.css("background-color","grey");
    	}
    	return true;
    }

    });

	
    // and the rest of your code
}*/


// ---------------------------------------------------------------------------------------
// jQuery bind
// ---------------------------------------------------------------------------------------
$( function () {
	$('#chatbox').hide();
	$('#chatboxCompany').hide();
	
	// Send Event bind
	$('#send-button').click( function () {
		var send = $('#messageTextInput');
		var messageBody = send.val();
		var MessageSub = 'chat';
		//var sender = 'sada';
		//var sender = echo ($_COOKIE['username']);
		//alert(document.cookie);
		var sender = getCookie(document.cookie);
		alert(sender);
		alert(currentTalent);
		postMessageForTalentTalk(sender, currentTalent, MessageSub, messageBody);
		send.val('');
		return false;
	});
	
	$('#send-button-company').click( function () {
		var send = $('#companyMessageTextInput');
		var messageBody = send.val();
		var MessageSub = 'chat';
		//var student = 'sada';
		//alert(document.cookie);
		var student = getCookie(document.cookie);
		//alert(student);
		postMessageForCompanyTalk(student, currentCompany, MessageSub, messageBody);
		send.val('');
		return false;
	});
	

	// Chat List Event bind
	$('#chat-user-list > li').click( function () {
		$('#userList').hide();
		$('#chatbox').show();
		var $this = $(this);
		var receiver = $this.find("a").text().substring(1);
		currentTalent = receiver;
		currentTalentMessageLength = 0;

		$('#title').text("Chatting with : " + receiver);

		if (bubbles_talent > 0) {
			$("#wrapper").empty();
			bubbles_talent = 0;
		}
		
		//var sender = 'sada';
		//var sender = echo ($_COOKIE['username']);
		//var sender= <?php echo $_COOKIE['username']; ?>;
		//alert(document.cookie);
		var sender = getCookie(document.cookie);
		//alert(sender);
		retrieveMessagesForTalentTalk(sender, receiver);
		intervalTalent = setInterval( function () {
    		retrieveMessagesForTalentTalk(sender, receiver) // this will run after every 5 seconds
		}, 100);
	});
	
	$('#chat-user-list-company > li').click( function () {
		$('#companyList').hide();
		$('#chatboxCompany').show();
		var $this = $(this);
		var companyName = $this.find("a").text().substring(1);
		currentCompany = companyName;
		currentCompanyMessageLength = 0;
		
		$('#companyTitle').text("Chatting with : " + companyName);
		
		if (bubbles_company > 0) {
			$("#wrapperCompany").empty();
			bubbles_company = 0;
		}
		
		//var student = 'sada';
		//var student = echo ($_COOKIE['username']);
		//alert(student);
		//alert(document.cookie);
		var student = getCookie(document.cookie);
		//alert(student);
		retrieveMessagesForCompanyTalk(companyName, student);
		intervalCompany = setInterval( function () {
			retrieveMessagesForCompanyTalk(companyName, student);
		}, 100);
	});


	// Back button event bind
	$('#backToList').click( function () {
		$('#userList').show();
		$('#chatbox').hide();
		currentTalent = '';
		clearInterval(intervalTalent);
		//currentTalentMessageLength = 0;
		return false;
	});
	
	$('#backToListCompany').click( function () {
		$('#companyList').show();
		$('#chatboxCompany').hide();
		currentCompany = '';
		clearInterval(intervalCompany);
		//currentCompanyMessageLength = 0;
		return false;
	});
});