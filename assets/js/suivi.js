let NextBtn = document.querySelector('#NextBtn');
let PrevBtn = document.querySelector('#PrevBtn');
let SubmitBtn = document.querySelector('#SubmitBtn');
let formBoxs = document.querySelectorAll('.form-box');
let steps = document.querySelectorAll('.step');
let index = 0;

/* Btn Suivant event */
NextBtn.onclick = (e) => {
  if(index == formBoxs.length -1) return;

  PrevBtn.style.display = "block"
  formBoxs[index].classList.remove('active');
  index ++;

  formBoxs[index].classList.add('active');
  steps[index].classList.add('active');

  if(index == formBoxs.length -1){
    SubmitBtn.style.display = "block"
    NextBtn.style.display = "none"
  }
}

/* Btn Suivant event */
window.onload =()=> {
  if(index == 0) PrevBtn.style.display = "none";
}

PrevBtn.onclick =()=> {
  if(index <= 0) {
    return
  } else if(index == 1) {
    PrevBtn.style.display = "none"
    SubmitBtn.style.display = "none"
    NextBtn.style.display = "block"
  
    formBoxs[index].classList.remove('active');
    steps[index].classList.remove('active');
    
    index --;
  
    formBoxs[index].classList.add('active');
  } else {
    SubmitBtn.style.display = "none"
    NextBtn.style.display = "block"
  
    formBoxs[index].classList.remove('active');
    steps[index].classList.remove('active');

    index --;
  
    formBoxs[index].classList.add('active');
  };
}