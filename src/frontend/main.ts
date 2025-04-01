import './estils/style.css';
import { getPageType } from './utils/urlPath';
import { cinema } from './pages/cinema/funcions';
import { loginPage } from './pages/login/funcions';
import { vault } from './pages/vault/funcions';
import { historiaOberta } from './pages/historiaOberta/historiaOberta';
import { biblioteca } from './pages/biblioteca/biblioteca';

const url = window.location.href;
const pageType = getPageType(url);

document.addEventListener('DOMContentLoaded', () => {
  console.log(pageType);
  if (pageType[1] === 'cinema') {
    cinema();
  } else if (pageType[1] === 'entrada') {
    loginPage();
  } else if (pageType[1] === 'vault') {
    vault();
  } else if (pageType[1] === 'historia-oberta') {
    historiaOberta();
  } else if (pageType[1] === 'biblioteca') {
    biblioteca();
  }
});
