const menubtn = document.querySelector("#menubtn")
      
menubtn.addEventListener('click' , function(){
    const sidebar = document.querySelector("#sidebar_div")
    sidebar.classList.toggle('active');
    this.classList.toggle('fa-bars');
    this.classList.toggle('fa-times');
});

document.addEventListener('click' , function (e) {
    if (!sidebar.contains(e.target) && !menubtn.contains(e.target)) {
        sidebar.classList.remove('active');
        menubtn.classList.add('fa-bars');
        menubtn.classList.remove('fa-times');
    }
});