function confirmSiteSubMenu(id) {
    if (confirm("Are you sure you want to delete this site-sub menu?")) {
        deleteSiteSubMenu(id);
    }
}

function deleteSiteSubMenu(id) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "scripts/ajax/DeleteSiteSubMenu.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                if (response === "success") {
                    // Successful deletion
                    location.reload(true);
                } else {
                    alert("Error deleting site menu: " + response);
                }
            }
        }
    };
    xhr.send("id=" + id); // Use lowercase "id" to match PHP script
}
