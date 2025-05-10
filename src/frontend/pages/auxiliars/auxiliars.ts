import { getPageType } from '../../utils/urlPath';
import { taulaLlistatImatges } from './taulaLlistatImatges';

const url = window.location.href;
const pageType = getPageType(url);

export function auxiliars() {
  if ([pageType[2]].includes('llistat-imatges')) {
    taulaLlistatImatges();
  }
}
