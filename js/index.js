let about = document.querySelector('.about');
let mainBox = document.querySelector('.mainBox');
let slideImg = document.querySelector('.slideImg');
let imgBox = document.querySelectorAll('.imgBox');
let slide2 = document.querySelector('.slide2');
let imgBox2 = document.querySelectorAll('.imgBox2');
let inputUsers = document.querySelectorAll('.inputUser');
let labelInputs = document.querySelectorAll('.labelInput');
let selectOptions = document.querySelectorAll('.boxInput>.inputUser>option');
let widthSlide1 = imgBox[0].clientWidth;
let widthSlide2 = imgBox2[0].clientWidth;
let heightSectionServices = mainBox.clientHeight;
let counter = 1;
let counterSlide2 = 1;
let interval = 3500;

/* To resize section about margin */
window.onload =()=> {
  heightSectionServices = mainBox.clientHeight;
  about.style.marginTop = heightSectionServices-48+"px";
}

/* SlideImg start */

/* SlideImg start */
window.onresize =()=> {
  widthWindow = window.innerWidth;
  widthSlide1 = imgBox[0].clientWidth;
  widthSlide2 = imgBox2[0].clientWidth;
  heightSectionServices = mainBox.clientHeight;

  about.style.marginTop = heightSectionServices-48+"px";

  /* Scroll-header */
  if(widthWindow < 991){
    wrapper.style.position = "fixed";
    wrapper.style.top = "0";
    main.style.marginTop = "5rem";
  } else {
    wrapper.style.background = "url('./img/background.png')";
  }
}
/* SlideImg end */

setInterval(()=> {
  slide();
}, interval);

slide =()=> {
  slideImg.style.transform = "translate("+(-widthSlide1*counter)+"px)";
  counter++;

  slide2.style.transform = "translate("+(-widthSlide2*counterSlide2)+"px)";
  counterSlide2++;

  if(counter == imgBox.length +1){
    slideImg.style.transform = "translate(0px)";
    counter = 1;
  }

  if(counterSlide2 == imgBox2.length +1){
    slide2.style.transform = "translate(0px)";
    counterSlide2 = 1;
  }
}
/* SlideImg end */

/* Input:focus ~ label start */
for(i=0; i < inputUsers.length; i++){
  let inputUser = inputUsers[i];
  let labelInput = labelInputs[i];

  inputUser.addEventListener("focusin", ()=> {
    if(inputUser.value == ""){
      labelInput.style.color = '#3db166';
      labelInput.style.top = "-.9rem";
      labelInput.style.left = "0";
      labelInput.style.fontSize = ".7rem";
      labelInput.style.border = ".1rem solid #3db166";
      labelInput.style.borderBottom = ".1rem solid transparent";
      inputUser.style.borderBottom = ".1rem solid #3db166";
    }
  })
  
  inputUser.addEventListener("focusout", ()=> {
    if(inputUser.value == ""){
      labelInput.style.color = '#96aad3';
      labelInput.style.top = "1.5rem";
      labelInput.style.left = "1rem";
      labelInput.style.fontSize = "1rem";
      labelInput.style.border = ".1rem solid transparent";
      inputUser.style.borderBottom = ".1rem solid transparent";
    }
  })
}

/* Input:focus ~ label end */



/* option:hover ~ select start */

// for(i=0; i < selectOptions.length; i++){
//   let option = selectOptions[i];

//   option.onclick =()=> {
//     console.log(option);
//   }
// }

/* option:hover ~ select end */