
function confirmSiteIdentityDelete(id) {
    // Show a confirmation dialog
    if (confirm("Are you sure you want to delete this content?")) {
        // User confirmed, proceed with deletion
        deleteSiteIdentity(id);
    }
}

function deleteSiteIdentity(id) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "scripts/ajax/DeleteSiteIdentity.php", true); 
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
    xhr.send("id=" + id);
}

