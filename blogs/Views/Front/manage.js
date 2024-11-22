// Select DOM elements
const createForm = document.getElementById("create-form");
const blogsContainer = document.getElementById("blogs-container");
const readBlogSection = document.getElementById("read-blog");
const readTitle = document.getElementById("read-title");
const readContent = document.getElementById("read-content");
const backButton = document.getElementById("back-button");

// Store blogs in-memory (for simplicity)
let blogs = [];

// Function to render blogs in the list
function renderBlogs() {
    blogsContainer.innerHTML = "";
    blogs.forEach((blog, index) => {
        const li = document.createElement("li");
        li.innerHTML = `
            <h3>${blog.title}</h3>
            <p>${blog.content.substring(0, 50)}...</p>
            <button onclick="viewBlog(${index})">Read</button>
            <button onclick="editBlog(${index})">Edit</button>
            <button onclick="deleteBlog(${index})">Delete</button>
        `;
        blogsContainer.appendChild(li);
    });
}

// Handle blog creation
createForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const title = e.target.title.value;
    const content = e.target.content.value;

    blogs.push({ title, content });
    e.target.reset();
    renderBlogs();
});


// Handle back button
backButton.addEventListener("click", () => {
    readBlogSection.style.display = "none";
    document.querySelector("main").style.display = "block";
});

// Handle blog editing
function editBlog(index) {
    const blog = blogs[index];
    const newTitle = prompt("Edit Title", blog.title);
    const newContent = prompt("Edit Content", blog.content);

    if (newTitle && newContent) {
        blogs[index] = { title: newTitle, content: newContent };
        renderBlogs();
    }
}

// Handle blog deletion
function deleteBlog(index) {
    if (confirm("Are you sure you want to delete this blog?")) {
        blogs.splice(index, 1);
        renderBlogs();
    }
}

// Initial rendering of blogs
renderBlogs();
