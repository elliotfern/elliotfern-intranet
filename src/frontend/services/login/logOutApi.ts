export async function logout() {
  try {
    // Llamar al backend para realizar el logout
    const url = `https://${window.location.host}/api/auth/get/?logOut`;

    const response = await fetch(url, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
    });
    const data = await response.json();

    if (data.message === 'OK') {
      // Elimina la clave isAdmin en localStorage
      localStorage.clear();
      sessionStorage.clear();

      // Redirige al usuario a la página "elliot.cat"
      window.location.href = 'https://elliot.cat';
    } else {
      console.error('Error al hacer logout:', data);
    }
  } catch (error) {
    console.error('Error en la llamada al backend:', error);
  }
}
