let formSelects = document.querySelectorAll(".form-filter");
formSelects = Array.from(formSelects);
formSelects.forEach(formSelect => {
    formSelect.addEventListener("input", function(select){
        console.log(select.currentTarget.value);
    });
});