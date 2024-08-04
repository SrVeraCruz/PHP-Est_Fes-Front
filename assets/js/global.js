/* Global Variables */ 
const globalUrl = 'https://php-estfes-front-production.up.railway.app/';
// const globalUrl = 'http://localhost/EST_FES_SITE/est-usmba.ac.ma_2.0/';

const endPointCategories = `${globalUrl}api/categories`;
const endPointItems = `${globalUrl}api/items`;


/* Functions */
const FetchAllCats = async () => {
  return await axios.get(endPointCategories)
  .then(res => {
    return res.data
  })
  .catch(err => {
    console.error(err.message)
  })
}

const FetchAllItems = async () => {
  return await axios.get(endPointItems)
  .then(res => {
    return res.data
  })
  .catch(err => {
    console.error(err.message)
  })
}
/* Functions */

const activeNavBarFunctions = () => {
  const body = document.querySelector('.body');
  const main = document.querySelector('.main');
  const navBar = document.querySelector('.nav-bar');
  const list = document.querySelector('.list');
  const slideOut = document.querySelector('.slideOut');
  const closeNavBar = document.querySelector('.fa-times');
  const linkListHover = document.querySelectorAll('.linkListHover');
  const listHover = document.querySelectorAll('.nav_hover');
  const linkListHover2 = document.querySelectorAll('.linkListHover2');
  const listHover2 = document.querySelectorAll('.nav_hover2');
  const closeListHover1 = document.querySelectorAll('.closeListHover1');
  const closeListHover2 = document.querySelectorAll('.closeListHover2');

  /* To open the nav_hover */
  for(i=0; i < linkListHover.length; i++){
    let link = linkListHover[i];
    let listElement = listHover[i];
    link.onclick =(e)=> { 
      e.preventDefault()
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

  /* To open navBar */
  navBar.onclick =()=> {
    navBar.classList.toggle('active');
    list.classList.toggle('active');
    body.classList.toggle('active');
    main.classList.toggle('active');
    slideOut.classList.toggle('active');
  }

  /* To close navBar */
  closeNavBar.onclick =()=> {
    navBar.classList.remove('active');
    list.classList.remove('active');
    body.classList.remove('active');
    main.classList.toggle('active');
    slideOut.classList.remove('active');
  }

  /* To close slideOut */
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
}


/* Show Navbar Data */
const navBarList = document.getElementById("navBarList")

const showNavData = async (cats) => {
  const mainList = document.createElement('ul')
  const subList = document.createElement('ul')

  const items = await FetchAllItems()

  const motDir = items.filter((it) => it.name === "Mot du Directeur")[0]
  const catNoParent = cats.filter(
    (cat) => cat.parent_category_id === 0 && cat.navbar_status === 0
  )

  navBarList.innerHTML = `
    <li class="scrollHeader">
      <div class="main_nav">
        <a href="#" class="linkListHover">
          accueil
        </a><i class="fa fa-play fa-rotate-90"></i>
        <i class="fa fa-angle-right"></i>
      </div>
      <div class="nav_hover">
        <i class="fa fa-angle-left closeListHover1"></i>
        <ul>
          <li><a href="index.php">accueil</a></li>
            <li>
              <a href="item.php?title=${motDir.slug}">${motDir.name}</a>
            </li>
        </ul>
      </div>
    </li>
  `

  if(catNoParent.length) {
    catNoParent.forEach((cat) => {
      const subCats = cats.filter(
        (ct) => ct.parent_category_id === cat.id && ct.navbar_status === 0
      )

      const itemCatNoParent = items.filter(
        (it) => it.category_id === cat.id && it.status === 0
      )

      mainList.innerHTML = ''
      if(subCats.length) {
        subCats.forEach((ct) => {
          const subItems = items.filter(
            (it) => it.category_id === ct.id && it.status === 0
          )

          subList.innerHTML = ''
          if(subItems.length) {
            subItems.forEach((subIt) => {
              subList.innerHTML += `
                <li>
                  <a href="item.php?title=${subIt.slug}">
                    ${subIt.name}
                  </a>
                </li>
              `
            })
          }

          mainList.innerHTML += `
            <li>
              <div class="children1">
                <a href="#" class="linkListHover2">${ct.name}</a>
                <i class="fa fa-play"></i>
                <i class="fa fa-angle-right"></i>
              </div>
              <div class="nav_hover2">
                <i class="fa fa-angle-left closeListHover2"></i>
                <ul>
                  ${subList.innerHTML}
                </ul>
              </div>
            </li>
          `
        })
        
      }

      if(itemCatNoParent.length) {
        itemCatNoParent.forEach((it) => {
          mainList.innerHTML += `
            <li>
              <div class="children1">
                <a href="item.php?title=${it.slug}">
                  ${it.name}
                </a>
              </div>
            </li>
          `
        })
        
      }

      navBarList.innerHTML += `
        <li class="scrollHeader">
          <div class="main_nav">
            <a href="#" class="linkListHover">${cat.name}</a>
            <i class="fa fa-play fa-rotate-90"></i>
            <i class="fa fa-angle-right"></i>
          </div>
          <div class="nav_hover">
            <i class="fa fa-angle-left closeListHover1"></i>
            <ul>
              ${mainList.innerHTML}
            </ul>
          </div>
        </li>
      `
    })
  }


  navBarList.innerHTML += `
    <li class="scrollHeader">
      <div class="main_nav">
        <a href="./suivi.php">suivi des lauréats</a>
      </div>
    </li>
    <li class="scrollHeader">
      <div class="main_nav">
        <a href="./contact.php">contact</a>
      </div>
    </li>
  `

  activeNavBarFunctions()
}

FetchAllCats().then((cats) => {
  showNavData(cats)
})

/* Show Navbar Data */


/* Utils */
  const wrapper = document.querySelector('.wrapper');
  const estLogo = document.querySelector('.estLogo');
  const ancar = document.querySelector('.ancar');
  let widthWindow = window.innerWidth;

  /* SlideImg start */
  window.onresize =()=> {
    widthWindow = window.innerWidth;

    /* Scroll-header */
    if(widthWindow < 1090){
      wrapper.style.position = "fixed";
      wrapper.style.top = "0";
      main.style.marginTop = "5rem";
    } else {
      wrapper.style.background = "url('./assets/img/background.png')";

      if(window.scrollY > 150){
        wrapper.style.position = "fixed";
        wrapper.style.top = "-9.5rem";
        main.style.marginTop = "16rem";
        wrapper.style.background = "#fff";
        wrapper.style.transition = "unset";
        estLogo.style.opacity = 1;
      } else {
        wrapper.style.position = "static";
        wrapper.style.top = "0";
        main.style.marginTop = "0";
        wrapper.style.background = "url('./assets/img/background.png')";
        estLogo.style.opacity = 0;
      }
    }
  }
  /* SlideImg end */

  /* Scroll-header start */
  window.onscroll =()=> {
    if(widthWindow > 1090){
      if(window.scrollY > 150){
        wrapper.style.position = "fixed";
        wrapper.style.top = "-9.5rem";
        main.style.marginTop = "16rem";
        wrapper.style.background = "#fff";
        wrapper.style.transition = "unset";
        estLogo.style.opacity = 1;
      } else {
        wrapper.style.position = "static";
        wrapper.style.top = "0";
        main.style.marginTop = "0";
        wrapper.style.background = "url('./assets/img/background.png')";
        estLogo.style.opacity = 0;
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

/* Utils */