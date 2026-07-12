// Success Alert
function showSuccess(message, title = "Success") {
    Swal.fire({
        icon: "success",
        title: title,
        text: message,
        confirmButtonColor: "#c9a44c"
    });
}

// Error Alert
function showError(message, title = "Error") {
    Swal.fire({
        icon: "error",
        title: title,
        text: message,
        confirmButtonColor: "#dc3545"
    });
}

// Warning Alert
function showWarning(message, title = "Warning") {
    Swal.fire({
        icon: "warning",
        title: title,
        text: message,
        confirmButtonColor: "#f0ad4e"
    });
}

// Information Alert
function showInfo(message, title = "Information") {
    Swal.fire({
        icon: "info",
        title: title,
        text: message,
        confirmButtonColor: "#0d6efd"
    });
}

// Toast Notification
function showToast(message, icon = "success") {

    Swal.fire({
        toast: true,
        position: "top-end",
        icon: icon,
        title: message,
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true
    });

}

// Confirmation Dialog
function confirmAction(title, text) {

    return Swal.fire({
        title: title,
        text: text,
        icon: "question",

        showCancelButton: true,

        confirmButtonText: "Yes",
        cancelButtonText: "Cancel",

        confirmButtonColor: "#c9a44c",
        cancelButtonColor: "#6c757d"

    });

}

// Delete Confirmation
function confirmDelete(item = "this record") {

    return Swal.fire({
        title: "Delete Confirmation",
        text: "Are you sure you want to delete " + item + "?",
        icon: "warning",

        showCancelButton: true,
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel",

        confirmButtonColor: "#dc3545",
        cancelButtonColor: "#6c757d"
    });

}

// Loading Screen
function showLoading(message = "Please wait...") {

    Swal.fire({
        title: message,

        allowOutsideClick: false,
        allowEscapeKey: false,

        didOpen: () => {
            Swal.showLoading();
        }
    });

}

// Close Loading Screen
function hideLoading() {
    Swal.close();
}
