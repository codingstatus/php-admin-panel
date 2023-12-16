
function confirmContentDelete(id) {
    // Show a confirmation dialog
    if (confirm("Are you sure you want to delete this content?")) {
        // User confirmed, proceed with deletion
        deleteContent(id);
    }
}

function deleteContent(id) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "scripts/ajax/DeleteContent.php", true); 
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                
                if (response) {
                    location.reload(true);
                   
                } else {
                    alert("Error deleting content: " + response);
                }
            }
        }
    };
    xhr.send("contentId=" + id);
}

