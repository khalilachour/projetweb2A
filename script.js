document.getElementById("editButton").addEventListener("click", function() {
    var editUrl = "<?php echo 'edit.php?id=' . $element->id ?>";
    window.location.href = editUrl;
});

