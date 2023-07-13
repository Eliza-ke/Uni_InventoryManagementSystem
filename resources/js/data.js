fetch('/api/data')
    .then(response => response.json())
    .then(data => {
        // Process the data and generate output
        data.forEach(item => {
            // Access item properties and generate HTML elements dynamically
            var element = document.createElement('div');
            element.textContent = item.name;
            document.body.appendChild(element);
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });
