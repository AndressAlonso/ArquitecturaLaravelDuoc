document.addEventListener('DOMContentLoaded', function() {
    btnfilter = document.getElementById('btnfilter');
    formfilter = document.getElementById('formfilter');
    btnfilter.addEventListener('click', function() {
        console.log('click');
        formfilter.submit();
    });
});
   
