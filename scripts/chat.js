// Chat scrolling
function scrollChatBox() {
    var elDiv = document.getElementById('shoutbox');
    elDiv.scrollTop = elDiv.scrollHeight-elDiv.offsetHeight;
}

// Add a message
function addMessage() {
    var ajax = new XMLHttpRequest();

    msg.value = msg.value.replace(/\+/g, "plus");

    ajax.open("POST","chat.php?mode=add_message", true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.send("msg=" + msg.value);

    msg.value = "";

    showMessages();
}

// Get the messages
function showMessages() {
    var ajax = new XMLHttpRequest();

    ajax.open("POST","chat.php?mode=messages", true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.send(null);

    ajax.onreadystatechange = function() {
        if (ajax.readyState === 4 && ajax.status === 200){
            document.getElementById('shoutbox').innerHTML = ajax.responseText;
            scrollChatBox();
        }
    }
}

// Insert a smiley
function addSmiley(smiley) {
    msg.value = msg.value + smiley;
    msg.focus();
}

setInterval(showMessages, 3000);
