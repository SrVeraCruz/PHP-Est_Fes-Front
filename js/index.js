let wrapper = document.querySelector('.wrapper');
let body = document.querySelector('.body');
let main = document.querySelector('.main');
let about = document.querySelector('.about');
let mainBox = document.querySelector('.mainBox');
let estLogo = document.querySelector('.estLogo');
let navBar = document.querySelector('.nav-bar');
let slideOut = document.querySelector('.slideOut');
let closeNavBar = document.querySelector('.fa-times');
let closeListHover1 = document.querySelectorAll('.closeListHover1');
let closeListHover2 = document.querySelectorAll('.closeListHover2');
let list = document.querySelector('.list');
let listHover = document.querySelectorAll('.nav_hover');
let listHover2 = document.querySelectorAll('.nav_hover2');
let linkListHover = document.querySelectorAll('.linkListHover');
let linkListHover2 = document.querySelectorAll('.linkListHover2');
let slideImg = document.querySelector('.slideImg');
let imgBox = document.querySelectorAll('.imgBox');
let slide2 = document.querySelector('.slide2');
let imgBox2 = document.querySelectorAll('.imgBox2');
let scrollHeader = document.querySelectorAll('.scrollHeader');
let ancar = document.querySelector('.ancar');
let widthWindow = window.innerWidth;
let widthSlide1 = imgBox[0].clientWidth;
let widthSlide2 = imgBox2[0].clientWidth;
let heightSectionServices = mainBox.clientHeight;
let index = 0;
let counter = 1;
let counterSlide2 = 1;
let interval = 3500;

/* To resize section about margin */
window.onload =()=> {
  heightSectionServices = mainBox.clientHeight;
  about.style.marginTop = heightSectionServices-48+"px";
}

/* To open the nav_hover */
for(i=0; i < linkListHover.length; i++){
  let link = linkListHover[i];
  let listElement = listHover[i];
  link.onclick =()=> { 
    listElement.classList.add('active');
  }
}

/* To open the nav_hover2 */
for(i=0; i < linkListHover2.length; i++){
  let link = linkListHover2[i];
  let listElement = listHover2[i];
  link.onclick =()=> { 
    listElement.classList.add('active');
  }
}

/* To close the nav_hover1 */
for(i=0; i<closeListHover1.length; i++){
  button = closeListHover1[i];
  button.onclick =()=> {
    for(i=0; i < linkListHover.length; i++){
      let listElement = listHover[i];
      listElement.classList.remove('active');
    }
  }
}

/* To close the nav_hover2 */
for(i=0; i<closeListHover2.length; i++){
  button = closeListHover2[i];
  button.onclick =()=> {
    for(i=0; i < linkListHover2.length; i++){
      let listElement = listHover2[i];
      listElement.classList.remove('active');
    }
  }
}

/* To open the navBar */
navBar.onclick =()=> {
  navBar.classList.toggle('active');
  list.classList.toggle('active');
  body.classList.toggle('active');
  main.classList.toggle('active');
  slideOut.classList.toggle('active');
}
/* To close the navBar */
closeNavBar.onclick =()=> {
  navBar.classList.remove('active');
  list.classList.remove('active');
  body.classList.remove('active');
  main.classList.toggle('active');
  slideOut.classList.remove('active');
}

/* To close the slideOut */
slideOut.onclick =()=> {
  navBar.classList.remove('active');
  list.classList.remove('active');
  body.classList.remove('active');
  main.classList.toggle('active');
  slideOut.classList.remove('active');
  
  for(i=0; i < linkListHover.length; i++){
    let listElement = listHover[i];
    listElement.classList.remove('active');
  }
  
  for(i=0; i < linkListHover2.length; i++){
    let listElement = listHover2[i];
    listElement.classList.remove('active');
  }
}

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
    // for(i=0; i < scrollHeader.length; i++){
    //   scrollHeader[i].style.padding = "0";
    //   scrollHeader[i].style.paddingRight = "0";
    // }
  } else {
    wrapper.style.background = "url('./img/background.png')";
    // for(i=0; i < scrollHeader.length; i++){
    //   scrollHeader[i].style.padding = ".6rem";
    //   scrollHeader[i].style.paddingRight = ".2rem";
    // }
  }
}
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

/* Scroll-header start */
window.onscroll =()=> {
  if(widthWindow > 991){
    if(window.scrollY > 150){
      wrapper.style.position = "fixed";
      wrapper.style.top = "-9.5rem";
      main.style.marginTop = "16rem";
      wrapper.style.background = "#fff";
      wrapper.style.transition = "unset";
      estLogo.style.opacity = 1;
      // for(i=0; i < scrollHeader.length; i++){
      //   scrollHeader[i].style.padding = ".7rem";
      // }
    } else {
      wrapper.style.position = "static";
      wrapper.style.top = "0";
      main.style.marginTop = "0";
      wrapper.style.background = "url('./img/background.png')";
      estLogo.style.opacity = 0;
      // for(i=0; i < scrollHeader.length; i++){
      //   scrollHeader[i].style.padding = ".6rem";
      //   scrollHeader[i].style.paddingRight = ".2rem";
      // }
    }
  }

  if(window.scrollY > 300){
    ancar.style.opacity = 1;
    ancar.style.Zindex = 999;
  } else {
    ancar.style.opacity = 0;
    ancar.style.Zindex = -5;
  }
}
/* Scroll-header end */

