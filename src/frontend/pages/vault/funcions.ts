import { getPageType } from '../../utils/urlPath';
import { serveisVaultApi } from '../../components/vault/serveisVault';

export function vault() {
  const pageType = getPageType(1);
  if (pageType === 'vault') {
    serveisVaultApi();
  }
}
