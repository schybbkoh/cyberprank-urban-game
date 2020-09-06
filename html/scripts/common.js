function openForm(id) {
  document.getElementById(id).style.display = "block";
}

function closeForm(id) {
  document.getElementById(id).style.display = "none";
}

    var iframe = document.getElementById("iframe");
    iframe.onload = function(){
        iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
    }
