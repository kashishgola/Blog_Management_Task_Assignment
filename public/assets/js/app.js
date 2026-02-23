// BASE API URL
const API = "../api";

// ---------------- LOGIN FUNCTION -------------------
function loginUser() {
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    fetch(API + "/auth/login.php", {
        method: "POST",
        body: JSON.stringify({ email, password })
    })
        .then(res => res.json())
        .then(data => {
            if (data.token) {
                sessionStorage.setItem("token", data.token);
                window.location = "dashboard.php";
            } else {
                document.getElementById("msg").innerHTML =
                    `<div class="alert alert-danger">${data.error}</div>`;
            }
        });
}

// ---------------- LOGOUT -------------------
function logout() {
    sessionStorage.removeItem("token");
    window.location = "login.php";
}

// ---------------- LOAD POSTS -------------------
function loadPosts() {
    fetch(API + "/posts/list.php", {
        headers: { "Authorization": "Bearer " + sessionStorage.getItem("token") }
    })
        .then(res => res.json())
        .then(posts => {
            let html = `<table class="table table-bordered">
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>`;

            posts.forEach(p => {
                html += `
                <tr>
                    <td><a href="view_post.php?slug=${p.slug}" target="_blank">${p.title}</a></td>
                    <td>${p.author}</td>
                    <td>${p.created_at}</td>
                    <td>${p.status}</td>
                    <td>
                        <a href="edit_post.php?id=${p.id}" class="btn btn-sm btn-warning">Edit</a>
                        <button onclick="deletePost(${p.id})" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>`;
            });

            html += `</table>`;

            document.getElementById("postList").innerHTML = html;
        });
}

// ---------------- CREATE POST -------------------
function createPost() {
    let data = {
        title: document.getElementById("title").value,
        body: document.getElementById("body").value
    };

    fetch(API + "/posts/create.php", {
        method: "POST",
        headers: {
            "Authorization": "Bearer " + sessionStorage.getItem("token")
        },
        body: JSON.stringify(data)
    })
        .then(res => res.json())
        .then(() => {
            alert("Post Created");
            window.location = "dashboard.php";
        });
}

// ---------------- DELETE POST -------------------
function deletePost(id) {
    if (!confirm("Are you sure?")) return;

    fetch(API + "/posts/delete.php?id=" + id, {
        headers: { "Authorization": "Bearer " + sessionStorage.getItem("token") }
    })
        .then(res => res.json())
        .then(() => {
            alert("Deleted");
            loadPosts();
        });
}

// ---------------- LOAD PUBLIC POST -------------------
function loadPublicPost(slug) {     
    fetch(API + "/posts/view.php?slug=" + slug)
        .then(res => res.json())
        .then(p => {
            document.getElementById("postContent").innerHTML = `
                <h2>${p.title}</h2>
                <small>By ${p.author}</small><br><br>
                ${p.cover_media_url ? `<img src="${p.cover_media_url}" class="img-fluid mb-3">` : ''}
                <p>${p.body}</p>
                <small>Image via Pixabay</small>
            `;
        });
}
    
const searchBtn = document.getElementById('searchBtn');
const searchInput = document.getElementById('pixabaySearch');
const resultsDiv = document.getElementById('pixabayResults');
const mediaInput = document.getElementById('media_url');

searchBtn.addEventListener('click', () => { alert('tets');
    const query = searchInput.value.trim();
    if(!query) return alert("Enter a search term");

    
    fetch(`https://pixabay.com/api/?key=54761238-77e15fee65a2bcfde7ad52f02&q=${encodeURIComponent(query)}&image_type=photo&per_page=12`)
        .then(res => res.json())
        .then(data => {
            resultsDiv.innerHTML = '';
            if(data.hits.length === 0) {
                resultsDiv.innerHTML = 'No results found.';
                return;
            }
            data.hits.forEach(item => {
                const img = document.createElement('img');
                img.src = item.previewURL;
                img.style.width = '120px';
                img.style.margin = '5px';
                img.style.cursor = 'pointer';

                img.addEventListener('click', () => {
                    // Highlight selected image
                    document.querySelectorAll('#pixabayResults img').forEach(i => i.style.border = '');
                    img.style.border = '3px solid green';
                    mediaInput.value = item.largeImageURL; // save URL to hidden input
                });

                resultsDiv.appendChild(img);
            });
        })
        .catch(err => console.error(err));
});
