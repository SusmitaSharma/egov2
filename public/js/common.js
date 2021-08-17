function successMessage(message) {
    $.toast({
        text: message,
        icon: 'success',
        position:'top-right'
    });
}

function errorMessage(message = 'Something went wrong.') {
    $.toast({
        text: message,
        icon: 'error',
        position:'top-right'
    });
}
