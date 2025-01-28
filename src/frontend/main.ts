import 'bootstrap/dist/css/bootstrap.min.css';
import './style.css';
import 'bootstrap';
import { getPageType } from './utils/urlPath';
import { cinema } from './pages/cinema/funcions';

document.addEventListener('DOMContentLoaded', () => {
  const pageType = getPageType(1);
  const pageType2 = getPageType(3);

  console.log(pageType2);
  if (pageType2 === 'cinema') {
    cinema();
  }
});
