import { useEffect, useState } from "react";

function App() {
  const [datos, setDatos] = useState([]);

  // Función para obtener datos desde PHP
  const fetchData = () => {
    fetch("http://192.168.1.68/urequestESP32/obtener_datos.php")
      .then((response) => response.json())
      .then((data) => setDatos(data))
      .catch((error) => console.error("Error al obtener datos:", error));
  };

  // Cargar datos cada 5 segundos
  useEffect(() => {
    fetchData(); // Cargar datos al iniciar
    const interval = setInterval(fetchData, 5000); // Actualizar cada 5s

    return () => clearInterval(interval); // Limpiar el intervalo al desmontar
  }, []);

  return (
    <div className="container">
      <h1>Datos del Sensor LDR</h1>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nivel de Luz</th>
            <th>Fecha</th>
          </tr>
        </thead>
        <tbody>
          {datos.map((dato) => (
            <tr key={dato.id}>
              <td>{dato.id}</td>
              <td>{dato.nivel_luz}</td>
              <td>{dato.fecha}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}

export default App;
