import './estils/style.css';
import { getPageType } from './utils/urlPath';
import { cinema } from './pages/cinema/funcions';
import { loginPage } from './pages/login/funcions';
import { vault } from './pages/vault/funcions';
import { historiaOberta } from './pages/historiaOberta/historiaOberta';
import { biblioteca } from './pages/biblioteca/biblioteca';
import { adreces } from './pages/adreces/adreces';
import { persona } from './pages/persona/persona';

const url = window.location.href;
const pageType = getPageType(url);

document.addEventListener('DOMContentLoaded', () => {
  console.log(pageType);
  if (pageType[1] === 'cinema') {
    cinema();
  } else if (pageType[1] === 'entrada') {
    loginPage();
  } else if (pageType[1] === 'claus-privades') {
    vault();
  } else if (pageType[1] === 'historia') {
    historiaOberta();
  } else if (pageType[1] === 'biblioteca') {
    biblioteca();
  } else if (pageType[1] === 'adreces') {
    adreces();
  } else if (pageType[1] === 'base-dades-persones') {
    persona();
  }
});
