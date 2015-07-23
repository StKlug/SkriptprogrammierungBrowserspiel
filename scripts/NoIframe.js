if(inFrame()){
	alert("No Csrf!");
	$('*').remove();
}

$(function()
{
	$('iframe').remove();
});

function inFrame () {
    try {
        return window.self !== window.top;
    } catch (e) {
        return true;
    }
}