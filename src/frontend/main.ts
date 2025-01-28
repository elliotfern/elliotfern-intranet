import 'bootstrap/dist/css/bootstrap.min.css';
import './style.css';
import 'bootstrap';
import { getPageType } from './utils/urlPath';

document.addEventListener('DOMContentLoaded', () => {
  const pageType = getPageType(1);

  if (pageType === 'cinema') {
  }
});
