
function confirmDeleteCategory(id) {
    // Show a confirmation dialog
    if (confirm("Are you sure you want to delete this category?")) {
        // User confirmed, proceed with deletion
        deleteCategory(id);
    }
}

function deleteCategory(id) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "scripts/ajax/DeleteCategory.php", true); 
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                
                if (response) {
                    location.reload(true);
                   
                } else {
                    alert("Error deleting category: " + response);
                }
            }
        }
    };
    xhr.send("categoryId=" + id);
}

