document.addEventListener("DOMContentLoaded", function(event) {
    console.log('Working!');
});

document.querySelectorAll('.removeImage').forEach(btn => {
    btn.addEventListener('click',function () {
        let imageWrap = this.parentElement.parentNode;
        imageWrap.querySelector('.isRemoveImage').value = '1';
        imageWrap.querySelector('.preview').hidden = true;
        imageWrap.querySelector('.input-file').value = '';
        imageWrap.querySelector(".removeImage").hidden = true;
    })

});
