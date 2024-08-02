<?php
require_once '../Services/UserServices.php';
require_once '../Services/NewsServices.php';
require_once '../Services/EventServices.php';
require_once '../Services/NewsletterServices.php';
require_once '../Services/CategoryServices.php';
require_once '../Services/ItemServices.php';
require_once '../Services/SlideService.php';

header("Content-Type: application/json");
$uri = $_GET['url'];
$method = $_SERVER['REQUEST_METHOD'];

switch ($uri) {
  case 'api/users':
    if ($method === 'GET') {
      if (isset($_GET['id'])) {
        json_encode(UserService::GET($_GET['id']));
      } else {
        json_encode(UserService::GET());
      }
    } elseif ($method === 'POST') {
      if (isset($_POST['update_user_id'])) {
        json_encode(UserService::UPDATE($_POST, $_FILES));
      } elseif (isset($_POST['delete_user_id'])) {
        json_encode(UserService::DELETE($_POST));
      } else {
        json_encode(UserService::POST($_POST, $_FILES));
      }
    } else {
      sendNotAllowed();
    }
    break;

  case 'api/news':
    if ($method === 'GET') {
      if (isset($_GET['id'])) {
        json_encode(NewsService::GET($_GET['id']));
      } else if (isset($_GET['slug'])) {
        json_encode(NewsService::GET(null, $_GET['slug']));
      } else {
        json_encode(NewsService::GET());
      }
    } elseif ($method === 'POST') {
      if (isset($_POST['update_news_id'])) {
        json_encode(NewsService::UPDATE($_POST));
      } elseif (isset($_POST['delete_news_id'])) {
        json_encode(NewsService::DELETE($_POST));
      } else {
        json_encode(NewsService::POST($_POST));
      }
    } else {
      sendNotAllowed();
    }
    break;
  
  case 'api/events':
    if ($method === 'GET') {
      if (isset($_GET['id'])) {
        json_encode(EventService::GET($_GET['id']));
      } else if (isset($_GET['slug'])) {
        json_encode(EventService::GET(null, $_GET['slug']));
      } else {
        json_encode(EventService::GET());
      }
    } elseif ($method === 'POST') {
      if (isset($_POST['update_news_id'])) {
        json_encode(EventService::UPDATE($_POST));
      } elseif (isset($_POST['delete_news_id'])) {
        json_encode(EventService::DELETE($_POST));
      } else {
        json_encode(EventService::POST($_POST));
      }
    } else {
      sendNotAllowed();
    }
    break;

  case 'api/newsletter':
    if ($method === 'GET') {
      if (isset($_GET['id'])) {
        json_encode(NewsletterService::GET($_GET['id']));
      } else {
        json_encode(NewsletterService::GET());
      }
    } elseif ($method === 'POST') {
      if (isset($_POST['update_id'])) {
        json_encode(NewsletterService::UPDATE($_POST));
      } elseif (isset($_POST['delete_id'])) {
        json_encode(NewsletterService::DELETE($_POST));
      } else {
        json_encode(NewsletterService::POST($_POST));
      }
    } else {
      sendNotAllowed();
    }
    break;

  case 'api/categories':
    if ($method === 'GET') {
      if (isset($_GET['id'])) {
        json_encode(CategoryService::GET($_GET['id']));
      } else if (isset($_GET['slug'])) {
        json_encode(CategoryService::GET(null, $_GET['slug']));
      } else {
        json_encode(CategoryService::GET());
      }
    } elseif ($method === 'POST') {
      if (isset($_POST['update_cat_id'])) {
        json_encode(CategoryService::UPDATE($_POST, $_FILES));
      } elseif (isset($_POST['delete_cat_id'])) {
        json_encode(CategoryService::DELETE($_POST));
      } else {
        json_encode(CategoryService::POST($_POST, $_FILES));
      }
    } else {
      sendNotAllowed();
    }
    break;

  case 'api/items':
    if ($method === 'GET') {
      if (isset($_GET['id'])) {
        json_encode(ItemService::GET($_GET['id']));
      } else if (isset($_GET['slug'])) {
        json_encode(ItemService::GET(null, $_GET['slug']));
      } else {
        json_encode(ItemService::GET());
      }
    } elseif ($method === 'POST') {
      if (isset($_POST['update_item_id'])) {
        json_encode(ItemService::UPDATE($_POST, $_FILES));
      } elseif (isset($_POST['delete_item_id'])) {
        json_encode(ItemService::DELETE($_POST));
      } else {
        json_encode(ItemService::POST($_POST, $_FILES));
      }
    } else {
      sendNotAllowed();
    }
    break;

  case 'api/slides':
    if ($method === 'GET') {
      if (isset($_GET['id'])) {
        json_encode(SlideService::GET($_GET['id']));
      } else if (isset($_GET['slug'])) {
        json_encode(SlideService::GET(null, $_GET['slug']));
      } else {
        json_encode(SlideService::GET());
      }
    } elseif ($method === 'POST') {
      if (isset($_POST['update_cat_id'])) {
        json_encode(SlideService::UPDATE($_POST, $_FILES));
      } elseif (isset($_POST['delete_cat_id'])) {
        json_encode(SlideService::DELETE($_POST));
      } else {
        json_encode(SlideService::POST($_POST, $_FILES));
      }
    } else {
      sendNotAllowed();
    }
    break;

  case 'api/users/register':
    // require_once '../../middleware/redirect-user.php';
    session_start();

    if ($method === 'POST') {
      json_encode(UserService::POST($_POST, $_FILES));
    } else {
      sendNotAllowed();
    }
    break;

  case 'api/users/login':
    // require_once '../../middleware/redirect-user.php';
    session_start();

    if ($method === 'POST') {
      if (isset($_POST['email']) && isset($_POST['password'])) {
        json_encode(UserService::LOGIN($_POST['email'], $_POST['password']));
      } else {
        sendNotFound();
      }
    } else {
      sendNotAllowed();
    }
    break;

  case 'api/users/logout':
    if ($method === 'POST') {
      json_encode(UserService::LOGOUT());
    } else {
      sendNotAllowed();
    }
    break;

  default:
    sendNotFound();
    header('Location: 404.php');
    break;
}


function sendNotFound()
{
  http_response_code(404);
  echo json_encode(['message' => 'Not Found']);
}

function sendNotAllowed()
{
  http_response_code(405);
  echo json_encode(['message' => 'Method Not Allowed']);
}
