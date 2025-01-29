export async function loginApi(event: any) {
  event.preventDefault(); // Evitar el envío del formulario por defecto

  // Obtener los valores del formulario
  const usernameInput = document.getElementById('username') as HTMLInputElement;
  const passwordInput = document.getElementById('password') as HTMLInputElement;

  const loginMessageOk = document.getElementById('loginMessageOk');
  const loginMessageErr = document.getElementById('loginMessageErr');

  if (usernameInput && passwordInput) {
    const username = usernameInput.value;
    const password = passwordInput.value;
    try {
      const response = await fetch('/api/auth/login', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          username,
          password,
        }),
      });

      const data = await response.json();

      if (response.ok) {
        if (data.success) {
          // Guardar el token en localStorage
          localStorage.setItem('token', data.token);

          if (loginMessageOk && loginMessageErr) {
            // Mostrar mensaje de éxito
            loginMessageOk.style.display = 'block';
            loginMessageOk.innerHTML = data.message;
            loginMessageErr.style.display = 'none';
          }

          setTimeout(() => {
            window.location.href = '/gestio/admin';
          }, 3000);
        } else {
          if (loginMessageOk && loginMessageErr) {
            // Mostrar mensaje de éxito
            loginMessageErr.style.display = 'block';
            loginMessageErr.innerHTML = data.message;
            loginMessageOk.style.display = 'none';
          }
        }
      } else {
        throw new Error(data.message || 'Error en la sol·licitud');
      }
    } catch (error) {
      // Mostrar mensaje de error
      if (loginMessageOk && loginMessageErr) {
        // Mostrar mensaje de éxito
        loginMessageErr.style.display = 'block';
        loginMessageOk.style.display = 'none';
      }
    }
  }
}
