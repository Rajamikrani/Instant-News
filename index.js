const menubtn = document.querySelector("#menubtn")
      
menubtn.addEventListener('click' , function(){
    const sidebar = document.querySelector("#sidebar_div")
    sidebar.classList.toggle('active');
    this.classList.toggle('fa-bars');
    this.classList.toggle('fa-times');
});

document.addEventListener('click' , function (e) {
    if (!sidebar.contains(e.target) && !menubtn.contains(e.target)) {
        sidebar.classList.remove('active');
        menubtn.classList.add('fa-bars');
        menubtn.classList.remove('fa-times');
    }
});

document.addEventListener("DOMContentLoaded", function () {
    fetchNews("Breaking News" , "#breakingNews .news");
    fetchNews("Top Headlines" , "#topHeadlines .newsBox");
    fetchNews("Sports", "#sportsNews .newsBox");
    fetchNews("Business" , "#businessNews .newsBox");
    fetchNews("Technology" , "#technologyNews .newsBox");

     // Event delegation for click handling
  document.addEventListener('click', function(e) {
    const newsCard = e.target.closest('.newsCards');
    if (newsCard) {
        e.preventDefault();
        const link = newsCard.querySelector('a').href;
        window.location.href = link;
    }
});
});



function fetchNews(category, containerId) {
    fetch(`fetch_news.php?category=${encodeURIComponent(category)}`)
        .then(response => response.json())
        .then(data => {
            let container = document.querySelector(containerId);
            if (data.error) {
                container.innerHTML = `<p style="color:red;">${data.error}</p>`;
            } else {
                container.innerHTML = data.map(news => `
                    <div class="newsCards">
                        <div class="img">
                            <a href="news_detail.php?id=${news.article_id}" target="_blank">
                                <img src="/php_practice/news-site/reporter/${news.article_imageUrl}" 
                                     onerror="this.src='fallback.jpg';">
                            </a>
                        </div>
                        <div class="text">
                            <div class="title">
                                <a href="news_detail.php?id=${news.article_id}" target="_blank">
                                    <p>${news.article_title}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                `).join('');
            }
        })
        .catch(error => console.error("Error fetching news:", error));
}