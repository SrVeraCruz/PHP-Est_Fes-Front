/* Global Variables */ 
const baseUrl = 'https://est-usmba-ac-ma.up.railway.app/';
// const baseUrl = 'http://localhost:8082/';

const endpointLogin = `${baseUrl}api/users/login`;
const endpointLogout = `${baseUrl}api/users/logout`;
const endpointRegister = `${baseUrl}api/users/register`;
const endpointUsers = `${baseUrl}api/users`;
const endpointNews = `${baseUrl}api/news`;
const endpointEvents = `${baseUrl}api/events`;
const endpointNewsletter = `${baseUrl}api/newsletter`;
const endpointCategories = `${baseUrl}api/categories`;
const endpointItems = `${baseUrl}api/items`;
const endpointSlides = `${baseUrl}api/slides`;

const endpointImageCld = 'https://api.cloudinary.com/v1_1/dbfaih2du/image/upload';
const endpointRawCld = 'https://api.cloudinary.com/v1_1/dbfaih2du/raw/upload';

const rawPathCld = "https://res-console.cloudinary.com/dbfaih2du/media_explorer_thumbnails/"

const searchUrl = new URLSearchParams(window.location.search)
const pageUrl = location.pathname
const pageName = pageUrl.substring(pageUrl.lastIndexOf("/") + 1)


/* Global Functions */ 
//////////////////////////////////////////////////////////
const removePreloader = () => {
  const loader = document.getElementById("loader")
  if(loader) {
    loader.classList.add('hidden');
    loader.ontransitionend = () => {
      loader.remove()
    }
  }
}

const fetchAllUsers = async () => {
  return await axios.get(endpointUsers)
  .then(res => {
    return res.data
  })
  .catch(err => {
    console.error(err.message)
  })
}

const fetchOneUser = async (id) => {
  return await axios.get(`${endpointUsers}?id=${id}`)
  .then(res => {
    return res.data
  })
  .catch(err => {
    console.error(err.message)
  })
}

const fetchAllNews = async () => {
  return await axios.get(endpointNews)
  .then(res => {
    return res.data
  })
  .catch(err => {
    console.error(err.message)
  })
}

const fetchOneByNewsSlug = async (slug) => {
  return await axios.get(`${endpointNews}?slug=${slug}`)
  .then(res => {
    return res.data
  })
  .catch(err => {
    console.error(err.message)
  })
}

const fetchAllEvents = async () => {
  return await axios.get(endpointEvents)
  .then(res => {
    return res.data
  })
  .catch(err => {
    console.error(err.message)
  })
}

const fetchOneByEventSlug = async (slug) => {
  return await axios.get(`${endpointEvents}?slug=${slug}`)
  .then(res => {
    return res.data
  })
  .catch(err => {
    console.error(err.message)
  })
}

const fetchAllCats = async () => {
  return await axios.get(endpointCategories)
  .then(res => {
    return res.data
  })
  .catch(err => {
    console.error(err.message)
  })
}

const fetchOneCat = async (id) => {
  return await axios.get(`${endpointCategories}?id=${id}`)
  .then(res => {
    return res.data
  })
  .catch(err => {
    console.error(err.message)
  })
}

const fetchOneByCatSlug = async (slug) => {
  return await axios.get(`${endpointCategories}?slug=${slug}`)
  .then(res => {
    return res.data
  })
  .catch(err => {
    console.error(err.message)
  })
}

const fetchAllItems = async () => {
  return await axios.get(endpointItems)
  .then(res => {
    return res.data
  })
  .catch(err => {
    console.error(err.message)
  })
}

const fetchOneItem = async (id) => {
  return await axios.get(`${endpointItems}?id=${id}`)
  .then(res => {
    return res.data
  })
  .catch(err => {
    console.error(err.message)
  })
}

const fetchOneByItemSlug = async (slug) => {
  return await axios.get(`${endpointItems}?slug=${slug}`)
  .then(res => {
    return res.data
  })
  .catch(err => {
    console.error(err.message)
  })
}

const fetchAllItemsSlides = async () => {
  return await axios.get(endpointSlides)
  .then(res => {
    return res.data
  })
  .catch(err => {
    console.error(err.message)
  })
}

const handleUpload = async (file) => {
  const data = new FormData()
  data.append('file', file)
  data.append('upload_preset', 'est_uploads_file')

  if(file.type === 'application/pdf') {
    const res = await axios.post(endpointRawCld ,data)
    const fileUrl = `${rawPathCld + res.data.asset_id}/download`
    return fileUrl
  }

  const res = await axios.post(endpointImageCld ,data)
  return res.data.secure_url
}

const toastrAlert = (err) => {
  if (err.response && err.response.data) {
    if (err.response.data.message_warning) {
      toastr.warning(err.response.data.message_warning)
    } else if (err.response.data.message_error) {
      toastr.error(err.response.data.message_error)
    } else {
      toastr.error('Something went wrong!');
    }
  } else {
    toastr.error('Something went wrong!');
  }
}

const getTimeData = (dateStr) => {
  const dateObj = new Date(dateStr)
  const monthNames = [
    "JAVIER", "FEVRIER", "MARS", "AVRIL", 
    "MAI", "JUIN", "JUILLET", "AOUT", 
    "SEPTEMBRE", "OCTOBRE", "NOVEMBRE", "DECEMBRE"
  ];

  const day = dateObj.getDate();
  const month = monthNames[dateObj.getMonth()];
  const year = dateObj.getFullYear();

  const formattedDate = `${day} ${month} ${year}`;
  return formattedDate;
}

const getOtherNews = async (limit = null, withFeatured = true) => {
  const othersNews = document.createElement('div')
  const contentBox = document.createElement('div')
  othersNews.classList.add('othersNews')
  contentBox.classList.add('contentBox')

  let i = 0

  const res = await fetchAllNews()

  if(!res) {
    withFeatured 
    ? othersNews.innerHTML = `
        <div class="titre">
          <h1>Actualités et mise à jour</h1>
        </div>
        <span>Voulez vous vennir plus tard...</span>
      `
    : othersNews.innerHTML = ``

    return othersNews
  }

  
  const ordenedNews = res.reverse()
  
  
  if((!limit && limit !== 0) || limit >= ordenedNews.length) {
    limit = ordenedNews.length
  }

  if(limit < 0) {
    limit = 0
  }
  
  if(!withFeatured) {
    limit++
    i = 1
  }

  if(limit >= ordenedNews.length && !withFeatured) {
    limit = ordenedNews.length
  }

  for(i; i<limit; i++) {
    contentBox.innerHTML += `
      <div class="boxNews">
        <div class="boxNews__image">
          <img src="${ordenedNews[i].thumbnail}" alt="news">
          <a href="news.php?title=${ordenedNews[i].slug}"></a>
        </div>
        <div class="boxNews__info">
          <span>
            ${getTimeData(ordenedNews[i].created_at)}
          </span>
          <a href="news.php?title=${ordenedNews[i].slug}">
            ${ordenedNews[i].title}
          </a>
        </div>
      </div>
    `
  }

  if(withFeatured) {
    othersNews.innerHTML = `
      <div class="titre">
        <h1>Actualités et mise à jour</h1>
      </div>
    `
  }
  othersNews.appendChild(contentBox)

  return othersNews
}

const getEvents = async (limit = null, events = null) => {
  const eventBox = document.createElement('div')
  eventBox.classList.add('content')
  
  const res = await fetchAllEvents()
  
  if(!res) {
    events
    ? eventBox.innerHTML = ``
    : eventBox.innerHTML = `
      <div class="titre">
        <h1>Evènements à venir</h1>
      </div>
      <div id="seeAllEvent">
        <span>Voullez vous venir plus tard</span>
      </div>
    ` 

    return eventBox
  }

  const ordenedNews = events || res.reverse()
  
  if((!limit && limit !== 0) || limit >= ordenedNews.length) {
    limit = ordenedNews.length
  }

  if(limit < 0) {
    limit = 0
  }
  
  if((!limit && limit !== 0) && events) {
    limit = events.length
  }

  if(limit >= ordenedNews.length && !events) {
    limit = ordenedNews.length

    eventBox.innerHTML = `
      <div class="titre">
        <h1>Evènements à venir</h1>
      </div>
    `
  }

  
  for(let i=0; i<limit; i++) {
    const time = getTimeData(ordenedNews[i].date).split(' ')

    eventBox.innerHTML += `
      <div class="contentBox">
        <div class="box">
          <h1>${time[0].length === 1 ? '0'+time[0] : time[0]}</h1>
          <h3>${time[1]}</h3>
        </div>
        <div class="box">
          <a 
            href="event.php?title=${ordenedNews[i].slug}"
          >
            ${ordenedNews[i].title}
          </a>
          <div class="boxCoordene">
            <div class="clock">
              <i class="fa-regular fa-clock"></i>
              <p>${ordenedNews[i].time}</p>
            </div>
            <div class="location">
              <i class="fa fa-location-dot"></i>
              <p>${ordenedNews[i].location}</p>
            </div>
          </div>
        </div>
      </div>
    `
  }

  return eventBox
}


/* Index page */ 
//////////////////////////////////////////////////////////
if (pageName === '' || pageName === 'index.php') {
  const inputUsers = document.querySelectorAll('.inputUser');
  const labelInputs = document.querySelectorAll('.labelInput');
  const isLoading = [true,true,true]
  const verifyAndRemovePreloader = (index) => {
    isLoading[index] = false
    if(!isLoading[0] && !isLoading[1] && !isLoading[2]) {
      removePreloader()
    }
  }

  const firstSectionElement = document.getElementById('firstSection')
  const secondSectionElement = document.getElementById('secondSection')

  const formNewsletter = document.getElementById('formNewsletter')

  /* SlideImg start */
  window.onresize = () => {
    /* Scroll-header */
    if(widthWindow < 991){
      wrapper.style.position = "fixed";
      wrapper.style.top = "0";
      main.style.marginTop = "5rem";
    } else {
      wrapper.style.background = "url('./assets/img/background.png')";
    }
  }
  
  /* Slide start */
  const showSlides = (slides) => {
    const mainSlideWrapper = document.getElementById('mainSlideWrapper')
    const secondarySlideWrapper = document.getElementById('secondarySlide')

    const mainSlideData = slides.filter((item) => item.type === 'main')
    const secondarySlideData = slides.filter((item) => item.type === 'secondary')

    if (mainSlideData.length > 0) {
      mainSlideWrapper.innerHTML = ''
      mainSlideData.forEach(item => {
        mainSlideWrapper.innerHTML += `
          <div class="imgBox">
            <img 
              src="${item.image}" 
              alt="Main Slide"
            />
            <h1>${item.title}</h1>
          </div>
        ` 
      })
    }

    if (secondarySlideData.length > 0) {
      secondarySlideWrapper.innerHTML = ''
      secondarySlideData.forEach(item => {
        secondarySlideWrapper.innerHTML += `
          <div class="imgBox2">
            <img 
              src="${item.image}" 
              alt="Secondary Slide"
            />
          </div>
        ` 
      })
    }

    const slideImg = document.querySelector('.slideImg');
    const imgBox = document.querySelectorAll('.imgBox');
    const slide2 = document.querySelector('.slide2');
    const imgBox2 = document.querySelectorAll('.imgBox2');
    let widthSlide1 = imgBox[0].clientWidth;
    let widthSlide2 = imgBox2[0].clientWidth;
  
    const interval = 3500;
    let counter = 1;
    let counterSlide2 = 1;

    const slide = () => {
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

    window.onresize = () => {
      widthWindow = window.innerWidth;
      widthSlide1 = imgBox[0].clientWidth;
      widthSlide2 = imgBox2[0].clientWidth;
    }

    setInterval(() => {
      slide();
    }, interval);
  }

  fetchAllItemsSlides().then((slides) => {
    showSlides(slides)
  })
  /* Slide end */
  
  /* Input:focus ~ label start */
  for(i=0; i < inputUsers.length; i++){
    let inputUser = inputUsers[i];
    let labelInput = labelInputs[i];
  
    inputUser.addEventListener("focusin", () => {
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
    
    inputUser.addEventListener("focusout", () => {
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
  
  //   option.onclick = () => {
  //     console.log(option);
  //   }
  // }
  
  /* option:hover ~ select end */

  
  const showSectionsData = (cats, items) => {
    fetchOneByCatSlug('premier_section').then((pcat) => {
      const listCatsFirstSection = cats.filter(
        (filtCat) => filtCat.parent_category_id === pcat.id
      )
      
      const listItemsFirstSection = items.filter(
        (filtItem) => filtItem.category_id === pcat.id
      )

      listCatsFirstSection.forEach((fsCat) => {
        firstSectionElement.innerHTML += `
          <div class="box">
            <a href="category.php?title=${fsCat.slug}">
              ${
                fsCat.logo 
                ? `<img src="${fsCat.logo}" alt="${fsCat.title}">`
                : ''
              }
              <div class="contentBox">
                <h3>${fsCat.name}</h3>
                <span>
                  ${fsCat.title} <i class="fa-solid fa-location-arrow"></i>
                </span>
              </div>
            </a>
          </div>
        `
      })
      
      listItemsFirstSection.forEach((fsItem) => {
        firstSectionElement.innerHTML += `
          <div class="box">
            <a href="category.php?title=${fsItem.slug}">
              ${
                fsItem.logo 
                ? `<img src="${fsItem.logo}" alt="${fsItem.title}">`
                : ''
              }
              <div class="contentBox">
                <h3>${fsItem.name}</h3>
                <span>
                  ${fsItem.title} <i class="fa-solid fa-location-arrow"></i>
                </span>
              </div>
            </a>
          </div>
        `
      })

      fetchOneByCatSlug('deuxieme_section').then((dcat) => {
        const listCatsSecondSection = cats.filter(
          (filterCat) => filterCat.parent_category_id === dcat.id
        )

        const listItemsSecondSection = items.filter(
          (filtItem) => filtItem.category_id === dcat.id
        )

        listCatsSecondSection.forEach((ssCat) => {
          let customizedLink = `category.php?title=${ssCat.slug}`
          ssCat.name === 'CNR' && (customizedLink = 'note-consultation-login.php')
          secondSectionElement.innerHTML += `
            <div class="box">
              <a href="${customizedLink}">
                ${
                  ssCat.logo 
                  ? `<img src="${ssCat.logo}" alt="${ssCat.title}">`
                  : ''
                }
                <div class="contentBox">
                  <h3>${ssCat.name}</h3>
                  <span>
                    ${ssCat.title} <i class="fa-solid fa-location-arrow"></i>
                  </span>
                </div>
              </a>
            </div>
          `
        })
        
        listItemsSecondSection.forEach((ssItem) => {
          secondSectionElement.innerHTML += `
            <div class="box">
              <a href="category.php?title=${ssItem.slug}">
                ${
                  ssItem.logo 
                  ? `<img src="${ssItem.logo}" alt="${ssItem.title}">`
                  : ''
                }
                <div class="contentBox">
                  <h3>${ssItem.name}</h3>
                  <span>
                    ${ssItem.title} <i class="fa-solid fa-location-arrow"></i>
                  </span>
                </div>
              </a>
            </div>
          `
        })
        verifyAndRemovePreloader(0)
      })
    })
  }

  const showNews = async (allNews) => {
    const boxNews = document.getElementById('boxNews')
    const seeAllNews = document.getElementById('seeAllNews')
    const othersNews = document.createElement('div')
    const contentBox = document.createElement('div')
    othersNews.classList.add('othersNews')
    contentBox.classList.add('contentBox')

    if(!allNews) {
      seeAllNews.innerHTML = `
        <span>Voulez vous venir plus tard...</span>
      `
      return
    }

    const ordenedNews = allNews.reverse()
    
    seeAllNews.innerHTML = `
      <a href="news.php">Voir toutes les actualités</a>
    `
    
    boxNews.innerHTML = `
      <div class="contentBox">
        <div class="boxNews__image">
          <img src="${ordenedNews[0].thumbnail}" alt="Nouvelles en vedette">
          <a href="news.php?title=${ordenedNews[0].slug}"></a>
        </div>
        <div class="boxNews__info">
          <span>
            ${getTimeData(ordenedNews[0].created_at)}
          </span>
          <a href="news.php?title=${ordenedNews[0].slug}">
            ${ordenedNews[0].title}
          </a>
        </div>
      </div>
    `

    boxNews.appendChild(await getOtherNews(3, false))
  }

  const showEvents = async (allEvents) => {
    const eventWrapper = document.getElementById('eventWrapper')
    const seeAllEvent = document.getElementById('seeAllEvent')

    if(!allEvents) {
      seeAllEvent.innerHTML = `
        <span>Voulez vous venir plus tard...</span>
      `
      return
    }

    const ordenedEvent = allEvents.reverse()

    eventWrapper.appendChild(await getEvents(2, ordenedEvent))
  }

  /* newletter */
  (function(){
    emailjs.init({
      publicKey: "LojdCXuT0JhN9Vw53",
    });
  })();

  formNewsletter.onsubmit = async (ev) => {
    ev.preventDefault()
    
    const formData = new FormData()
    formData.append('email', ev.target.email.value)

    await axios.post(endpointNewsletter, formData)
    .then(() => {
      emailjs.send('service_b6dpaqs', 'template_dur5tct', {
        email: ev.target.email.value
      })
      .then(() => {
        location.href = 'newsletter.php?title=subscribed'
      }, () => {
        location.href = 'newsletter.php?title=subscribed'
      });
    })
    .catch((err) => {
      if (err.response && err.response.data) {
        if (err.response.data.message_unauthorized) {
          location.href = 'newsletter.php?title=unauthorized'
        } else if (err.response.data.message_already_subscribed) {
          location.href = 'newsletter.php?title=already_subscribed'
        }
      }

      toastrAlert(err)
    })
  }

  /* chercher cours */
  const searchCoursForm = document.getElementById("searchCoursForm")

  const showFillierSearchCours = (items) => {
    const selectFiliereDut = document.getElementById("selectFiliereDut")
    const selectFiliereLp = document.getElementById("selectFiliereLp")

    const filliersDut = items.filter((it) => it.category_name === 'DUT')
    const filliersLp = items.filter((it) => it.category_name === 'LP')
    
    if(filliersDut.length) {
      filliersDut.forEach((fDut) => {
        let dutName = fDut.name.substring(0,40)
        if(fDut.name.length >= 40) {
          dutName += ' ...'
        }

        selectFiliereDut.innerHTML += `
          <option value="${fDut.id}">${dutName}</option>
        ` 
      })
    }

    if(filliersLp.length) {
      filliersLp.forEach((fLp = []) => {
        let lpName = fLp.name.substring(0,40)
        if(fLp.name.length >= 40) {
          lpName += ' ...'
        }

        selectFiliereLp.innerHTML += `
          <option value="${fLp.id}">${lpName}</option>
        ` 
      })
    }
  }

  searchCoursForm.onsubmit = async (ev) => {
    ev.preventDefault()

    const dutId = ev.target.selectFiliereDut.value
    const lpId = ev.target.selectFiliereLp.value

    if(!dutId && !lpId) {
      toastr.warning("Voulez vous choisir une option de recherche")

    } else if(dutId && lpId) { 
      toastr.warning("Choisissez une option à la fois")

    } else {
      let searchParams = ''
      if(dutId) {
        const dut = await fetchOneItem(ev.target.selectFiliereDut.value)
        searchParams = `title=${dut.slug}`
      }

      if(lpId) {
        const lp = await fetchOneItem(ev.target.selectFiliereLp.value)
        searchParams = `title=${lp.slug}`
      }
      
      location.href = `item.php?${searchParams}`
    }
  }

  //////////////////////////////////
  fetchAllCats().then((cats) => {
    fetchAllItems().then((items) => {
      showSectionsData(cats, items)
      showFillierSearchCours(items)
    })
  })

  fetchAllNews().then((allNews) => {
    showNews(allNews)
    verifyAndRemovePreloader(1)
  })
  
  fetchAllEvents().then((allEvents) => {
    showEvents(allEvents)
    verifyAndRemovePreloader(2)
  })
}


/* Items page */ 
//////////////////////////////////////////////////////////
if(pageName === 'item.php') {
  const title = searchUrl.get('title')
  const itemsPage = document.getElementById('itemsPage')

  if(!title || title === '') {
    itemsPage.innerHTML = `
      <div class="headline">
        <h1>Error...</h1>
        <h2>Sorry invalid title...</h2>
      </div>
    `
  } else {
    const boxContainer = document.createElement('div')
    boxContainer.classList.add('boxContainer')

    const showItemData = (item) => {
      if(!item) {
        itemsPage.innerHTML = `
          <div class="headline">
            <h1>Error...</h1>
            <h2>Sorry no such data...</h2>
          </div>
        `
        return
      }

      const data_content = JSON.parse(item.data_content)

      itemsPage.innerHTML = `
        <div class="headline">
          <h1>${item.category_name}</h1>
          <h2>${item.title}</h2>
        </div>
      `

      boxContainer.innerHTML = ''
      data_content.forEach((data) => {
        boxContainer.innerHTML += `
          <div class="box">
            <div class="titre-container">
              <h2>${data.title}</h2>
            </div>
            <div class="box-content">
              ${data.description}
            </div>
          </div>
        `
      })

      if(item.file || item.file !== '') {
        boxContainer.innerHTML += `
          <div class="box">
            <div class="titre-container">
              <h2>Plus info</h2>
            </div>
            <div class="box-info">
              <a href="${item.file}" download="${item.name}" class="btn">Telecharger fichier <i class="fa fa-angle-right"></i></>
            </div>
          </div>
        `
      }

      itemsPage.appendChild(boxContainer)
    }

    fetchOneByItemSlug(title)
    .then((item) => {
      showItemData(item)
      removePreloader()
    })

  }
}

/* Category page */ 
//////////////////////////////////////////////////////////
if(pageName === 'category.php') {
  const title = searchUrl.get('title')
  const categoriesPage = document.getElementById('categoriesPage')
  const isLoading = [true, true]
  const verifyAndRemovePreloader = (index) => {
    isLoading[index] = false
    if(!isLoading[0] && !isLoading[1]) {
      removePreloader()
    }
  }

  if(!title || title === '') {
    categoriesPage.innerHTML = `
      <div class="headline">
        <h1>Error...</h1>
      </div>
      <h1>Sorry invalid title...</h1>
    `
  } else { 
    const boxContainer = document.createElement('div')
    boxContainer.classList.add('boxContainer')

    const showCatData = (cat) => {
      if(!cat) {
        categoriesPage.innerHTML = `
          <div class="headline">
            <h1>Error...</h1>
          </div>
          <h1>Sorry no such data...</h1>
        `
        return
      }

      categoriesPage.innerHTML = `
        <div class="headline">
          <h1>${cat.title}</h1>
        </div>
        <h1>EST-Fes <i class="fa-solid fa-graduation-cap"></i></h1>
      `

      fetchAllCats().then((allCats) => {
        const filteredCat = allCats.filter(
          (ct) => ct.parent_category_id === cat.id
        )

        boxContainer.innerHTML = ''
        filteredCat.forEach((fCat) => {
          let customizedLink = `category.php?title=${fCat.slug}`
          fCat.name === 'E-L' && (customizedLink = 'elearning-login.php')
          fCat.name === 'SL' && (customizedLink = 'suivi.php')

          boxContainer.innerHTML += `
            <div class="box">
              <a href="${customizedLink}">
                ${
                  fCat.logo 
                  ? `<img src="${fCat.logo}" alt="${fCat.title}">`
                  : ''
                }
                <div class="content-Box">
                  <h3>${fCat.name}</h3>
                  <span>${fCat.title} <i class="fa-solid fa-location-arrow"></i></span>
                </div>
              </a>
            </div>
          `
        })

        categoriesPage.appendChild(boxContainer)
        verifyAndRemovePreloader(0)
      })

      fetchAllItems().then((allItems) => {
        const filteredItems = allItems.filter(
          (it) => it.category_id === cat.id
        )

        filteredItems.forEach((fItem) => {
          boxContainer.innerHTML += `
            <div class="box">
              <a href="item.php?title=${fItem.slug}">
                ${
                  fItem.logo 
                  ? `<img src="${fItem.logo}" alt="${fItem.title}">`
                  : ''
                }
                <div class="content-Box">
                  <h3>${fItem.name}</h3>
                  <span>
                    ${fItem.title} <i class="fa-solid fa-location-arrow"></i>
                  </span>
                </div>
              </a>
            </div>
          `
        })

        verifyAndRemovePreloader(1)
      })
    }

    fetchOneByCatSlug(title)
    .then((cat) => {
      showCatData(cat)
    })
    
  }
}

/* News page */ 
//////////////////////////////////////////////////////////
if(pageName === 'news.php') {
  const title = searchUrl.get('title')
  const newsPage = document.getElementById('newsPage')
  const wrapperContainer = document.createElement('div')
  wrapperContainer.classList.add('wrapperContainer')

  const boxContainer = document.createElement('div')
  boxContainer.classList.add('boxContainer')

  if(!title || title === '') {
    newsPage.innerHTML = `
      <div class="headline">
        <h1>News</h1>
        <h2>Voulez choisir une nouvelle</h2>
      </div>
    `

    getOtherNews().then(res => {
      wrapperContainer.appendChild(res)
      removePreloader()
    })
      
    boxContainer.appendChild(wrapperContainer)
    newsPage.appendChild(boxContainer)
  } else {

    const showNewsData = async (news) => {
      if(!news) {
        newsPage.innerHTML = `
          <div class="headline">
            <h1>News</h1>
            <h2>Voulez choisir une nouvelle</h2>
          </div>
        `

        getOtherNews().then(res => {
          wrapperContainer.appendChild(res)
          removePreloader()
        })
          
        boxContainer.appendChild(wrapperContainer)
        newsPage.appendChild(boxContainer)
        return
      }

      newsPage.innerHTML = `
        <div class="headline">
          <h1>News</h1>
          <h2>${news.title}</h2>
        </div>
      `
      wrapperContainer.innerHTML = `
        <div class="box">
          <div class="box-content">
            ${news.content}
          </div>

          ${
            news.file ? `
              <div class="box-info">
                <h3>Plus info</h3>
                <div class="download">
                  <a
                    href="${news.file}?>" 
                    download="${news.title}"
                    
                  >
                    Telecharger fichier
                  </a>
                </div>
              </div>
            ` : ``
          }
        </div>
      `
      wrapperContainer.appendChild(await getOtherNews(5))
      
      boxContainer.appendChild(wrapperContainer)
      newsPage.appendChild(boxContainer)
      removePreloader()
    }

    fetchOneByNewsSlug(title).then((news) => {
      showNewsData(news)
    })
  }
}

/* Event page */ 
//////////////////////////////////////////////////////////
if(pageName === 'event.php') {
  const title = searchUrl.get('title')
  const eventPage = document.getElementById('eventPage')
  const wrapperContainer = document.createElement('div')
  wrapperContainer.classList.add('wrapperContainer')
  
  const boxContainer = document.createElement('div')
  boxContainer.classList.add('boxContainer')

  if(!title || title === '') {
    eventPage.innerHTML = `
      <div class="headline">
        <h1>Events</h1>
        <h2>Voulez choisir une nouvelle</h2>
      </div>
    `

    getEvents().then(res => {
      wrapperContainer.appendChild(res)
      removePreloader()
    })
      
    boxContainer.appendChild(wrapperContainer)
    eventPage.appendChild(boxContainer)
  } else {

    const showEventData = async (event) => {
      if(!event) {
        eventPage.innerHTML = `
          <div class="headline">
            <h1>Events</h1>
            <h2>Voulez choisir une nouvelle</h2>
          </div>
        `

        getEvents().then(res => {
          wrapperContainer.appendChild(res)
          removePreloader()
        })
          
        boxContainer.appendChild(wrapperContainer)
        eventPage.appendChild(boxContainer)
        return
      }

      eventPage.innerHTML = `
        <div class="headline">
          <h1>Events</h1>
          <h2>${event.title}</h2>
        </div>
      `
      wrapperContainer.innerHTML = `
        <div class="box">
          <div class="box-content">
            ${event.content}
          </div>

          ${
            event.file ? `
              <div class="box-info">
                <h3>Plus info</h3>
                <div class="download">
                  <a
                    href="${event.file}?>" 
                    download="${event.title}"
                    
                  >
                    Telecharger fichier
                  </a>
                </div>
              </div>
            ` : ``
          }
        </div>
      `
      wrapperContainer.appendChild(await getEvents(5))
      
      boxContainer.appendChild(wrapperContainer)
      eventPage.appendChild(boxContainer)
      removePreloader()
    }

    fetchOneByEventSlug(title).then((event) => {
      showEventData(event)
    })
  }
}


/* Newsletter page */ 
//////////////////////////////////////////////////////////
if(pageName === 'newsletter.php') {
  const title = searchUrl.get('title')
  const boxContainer = document.getElementById('boxContainer')

  if(title) {
    if(title === 'unauthorized') {
      boxContainer.innerHTML = `
        <p>Votre email n'est pas inscrit a l'ecole.</p>
        <p>
          Voulez vous contacter l'administration d'ecole: 
          <a href="mailto:est.usmba.fes@gmail.com">
            est.usmba.fes@gmail.com
          </a>
        </p>
      `
    } else if(title === 'already_subscribed') {
      boxContainer.innerHTML = `
        <p>
          Vous êtes déjà inscrit à notre newsletter.
        </p>
        <p>
          Restez à l'écoute pour recevoir nos actualités.
        </p>
      `
    } else if(title === 'subscribed') {
      boxContainer.innerHTML = `
        <p>Votre incription a été bien efectué.</p>
        <p>
          Restez à l'écoute, vous recevrez bientôt nos actualités.
        </p>
      `
    }
  } 
  removePreloader()
}

/* Suivi page */ 
//////////////////////////////////////////////////////////
if(pageName === 'suivi.php') {
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
    removePreloader()
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
}

/* Contact page */ 
//////////////////////////////////////////////////////////
if(pageName === 'contact.php') {
  window.onload = () => {
    removePreloader()
  }
}


/* Elearning register Page */ 
//////////////////////////////////////////////////////////
if(pageName === 'elearning-register.php') {
  const eLearningRegisterForm = document.getElementById('eLearningRegisterForm')

  window.onload = () => {
    removePreloader()
  }

  eLearningRegisterForm.onsubmit = async (event) => {
    event.preventDefault();

    let avatarUrl = ''
    const avatar = event.target.avatar.files[0]

    if(avatar) {
      avatarUrl = await handleUpload(avatar)
    }

    const formData = new FormData();
    formData.append('fname', event.target.fname.value)
    formData.append('lname', event.target.lname.value)
    formData.append('email', event.target.email.value)
    formData.append('password', event.target.password.value)
    formData.append('cpassword', event.target.cpassword.value)
    formData.append('birth', event.target.birth.value)
    formData.append('sex', event.target.sex.value)
    formData.append('avatar', avatarUrl)
    
    await axios.post(endpointRegister, formData)
    .then((res) => {
      window.location.href = "elearning-login.php";
      console.log(res.data)
    }).catch(err => {
      toastrAlert(err)
    })
  }
}
  
/* Elearning login Page */ 
//////////////////////////////////////////////////////////
if(pageName === 'elearning-login.php') { 
  const eLearningLoginForm = document.getElementById('eLearningLoginForm')

  window.onload = () => {
    removePreloader()
  }
  
  eLearningLoginForm.onsubmit = async (event) => {
    event.preventDefault();
    
    const formData = new FormData();
    formData.append('email', event.target.email.value)
    formData.append('password', event.target.password.value)
    
    await axios.post(endpointLogin, formData)
    .then(() => {
      location.href = "elearning.php";
    }).catch(err => {
      toastrAlert(err)
    })
  }
}


/* Logout event */ 
if(pageName === 'elearning.php' || pageName === 'note-consultation.php') {
  const logoutForm = document.getElementById("logoutForm");
  
  if(logoutForm) {
    logoutForm.onsubmit = (event) => {
      event.preventDefault()
      
      axios.post(endpointLogout)
      .then(() => {
        location.href = pageName === 'elearning.php' ? 'elearning-login.php' : 'note-consultation-login.php'
      })
      .catch(err => {
        toastrAlert(err)
      })
    }
  }
}  

/* Elearning page */ 
//////////////////////////////////////////////////////////
if(pageName === 'elearning.php') {  
  window.onload = () => {
    removePreloader()
  }  
}

/* Note consultation mixed */ 
//////////////////////////////////////////////////////////
if(pageName === 'note-consultation.php' || pageName === 'note-consultation-login.php') {  
  const logo = document.getElementById("logo");

  window.onload = () => {
    removePreloader()
  }

  logo.innerHTML = `
    <img src="./assets/img/esp_etudiant.png" alt="Espace etudiant">
  `
  
}

/* Note consultation login */ 
//////////////////////////////////////////////////////////
if(pageName === 'note-consultation-login.php') { 
  const noteConsultationLoginForm = document.getElementById('noteConsultationLoginForm')
  
  window.onload = () => {
    removePreloader()
  }
  
  noteConsultationLoginForm.onsubmit = async (event) => {
    event.preventDefault();
    
    const formData = new FormData();
    formData.append('email', event.target.email.value)
    formData.append('password', event.target.password.value)
    
    await axios.post(endpointLogin, formData)
    .then(() => {
      location.href = "note-consultation.php";
    }).catch(err => {
      toastrAlert(err)
    })
  }
}



/* Errors pages */ 
//////////////////////////////////////////////////////////
const loader = document.getElementById("loader")
if(pageName === '404.php') { 
  removePreloader()
}