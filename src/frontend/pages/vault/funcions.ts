import { getPageType } from '../../utils/urlPath';
import { serveisVaultApi } from '../../components/vault/serveisVault';

const url = window.location.href;
const pageType = getPageType(url);

export function vault() {
  if (pageType[1] === 'vault') {
    serveisVaultApi();
  }
}
