const firebaseConfig = {
  apiKey: "YOUR_API_KEY",
  authDomain: "YOUR_AUTH_DOMAIN",
  projectId: "YOUR_PROJECT_ID",
  storageBucket: "YOUR_STORAGE_BUCKET",
  messagingSenderId: "YOUR_MESSAGING_SENDER_ID",
  appId: "YOUR_APP_ID"
};

// Inicializa Firebase
const app = firebase.initializeApp(firebaseConfig);
const storage = firebase.storage();

function seleccionarfoto() {

  console.log('La función seleccionarfoto() se ha llamado.');


  const inputFoto = document.getElementById('foto');
  const inputFile = document.createElement('input');
  inputFile.type = 'file';
  
  // Añade un evento para cuando se selecciona un archivo
  inputFile.addEventListener('change', (event) => {
    const file = event.target.files[0];
    const storageRef = storage.ref();
    const fileRef = storageRef.child(`fotos_empleados/${file.name}`);

    fileRef.put(file).then((snapshot) => {
      console.log('Archivo subido con éxito');
      
      // Obtiene la URL de descarga del archivo
      fileRef.getDownloadURL().then((downloadURL) => {
        // Asigna la URL al input de foto
        inputFoto.value = downloadURL;
        console.log('URL de descarga:', downloadURL);
      });
    }).catch((error) => {
      console.error('Error al subir el archivo:', error);
    });
  });

  // Hacer clic en el elemento de tipo input de archivo creado
  inputFile.click();
}
