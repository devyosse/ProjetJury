
let messages = document.querySelectorAll('.success-message, .error-message');
if(messages) {
    setTimeout(() => messages.forEach(message => message.remove()), 4000);
}
