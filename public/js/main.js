// Configurar un interceptor para agregar el token en las solicitudes
axios.interceptors.request.use(config => {
  const token = localStorage.getItem('token');
  if (token) {
      config.headers['Authorization'] = 'Bearer ' + token;
  }
  return config;
}, error => {
  return Promise.reject(error);
});