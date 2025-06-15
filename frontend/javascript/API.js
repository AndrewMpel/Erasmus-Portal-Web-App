const API_URL = "http://localhost/Erasmus-Portal-Web-App/backend/RestAPI.php";

    function createUniversity() {
      const name = document.getElementById("name").value;
      const country = document.getElementById("country").value;

      fetch(API_URL, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ name, country })
      })
        .then(res => res.json())
        .then(data => {
          document.getElementById("create-response").textContent = JSON.stringify(data, null, 2);
        })
        .catch(err => {
          document.getElementById("create-response").textContent = "Error: " + err;
        });
    }

    function getAllUniversities() {
      fetch(API_URL)
        .then(res => res.json())
        .then(data => {
          document.getElementById("read-all-response").textContent = JSON.stringify(data, null, 2);
        })
        .catch(err => {
          document.getElementById("read-all-response").textContent = "Error: " + err;
        });
    }

    function getUniversityById() {
      const id = document.getElementById("read-id").value;

      fetch(`${API_URL}?id=${id}`)
        .then(res => res.json())
        .then(data => {
          document.getElementById("read-one-response").textContent = JSON.stringify(data, null, 2);
        })
        .catch(err => {
          document.getElementById("read-one-response").textContent = "Error: " + err;
        });
    }

    function updateUniversity() {
      const id = document.getElementById("update-id").value;
      const name = document.getElementById("update-name").value;
      const country = document.getElementById("update-country").value;

      fetch(`${API_URL}?id=${id}`, {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ name, country })
      })
        .then(res => res.json())
        .then(data => {
          document.getElementById("update-response").textContent = JSON.stringify(data, null, 2);
        })
        .catch(err => {
          document.getElementById("update-response").textContent = "Error: " + err;
        });
    }

    function deleteUniversity() {
      const id = document.getElementById("delete-id").value;

      fetch(`${API_URL}?id=${id}`, {
        method: "DELETE"
      })
        .then(res => res.json())
        .then(data => {
          document.getElementById("delete-response").textContent = JSON.stringify(data, null, 2);
        })
        .catch(err => {
          document.getElementById("delete-response").textContent = "Error: " + err;
        });
}