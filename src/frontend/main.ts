import './estils/style.css';
import { getPageType } from './utils/urlPath';
import { cinema } from './pages/cinema/funcions';
import { loginPage } from './pages/login/funcions';
import { vault } from './pages/vault/funcions';
import { historiaOberta } from './pages/historiaOberta/historiaOberta';

document.addEventListener('DOMContentLoaded', () => {
  const pageType = getPageType(1);
  const pageType2 = getPageType(3);

  if (pageType2 === 'cinema') {
    cinema();
  } else if (pageType === 'entrada') {
    loginPage();
  } else if (pageType === 'vault') {
    vault();
  } else if (pageType2 === 'historia-oberta') {
    historiaOberta();
  }
});
