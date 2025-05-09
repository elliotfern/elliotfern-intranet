import { getPageType } from '../../utils/urlPath';
import { taulaFacturacioClients } from './taulaFacturacioClients';

export function comptabilitat() {
  const url = window.location.href;
  const pageType = getPageType(url);

  console.log(`pagina comptabilitat ${pageType}`);
  if (pageType[2] === 'facturacio-clients') {
    taulaFacturacioClients();
  }
}
