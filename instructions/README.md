# Wise Publishing Frontend Challenge 👨‍💻

This challenge is meant to measure your capabilities as a **senior frontend developer** and assess your approach to solving complex frontend problems. We value clean architecture, attention to performance, and good user experience.

We appreciate adherence to **SOLID**, **KISS**, and **DRY** principles and encourage a focus on performance, **Core Web Vitals (CWV)**, and UI/UX skills.

We expect that an MVP (Minimum Viable Product) of this challenge will take roughly 3-4 hours. However you will have 2 business days to complete the task.

## Project Name: **WiseJobs** 🦉

### Requirements ⚙️

This project will use **Laravel** (as a backend framework) and **Alpine.js**, **vanilla JS**, **HTML**, **CSS**, and **Blade templating** for the frontend.

You are tasked with creating a responsive, performant, and user-friendly job board application called WiseJobs.

### Users 👥

**Users should be able to:**
- Scroll through the list of the latest published jobs.
- Filter jobs based on: position type (remote or in-person), salary, company, and location.
- View more details for each individual job.
- **Performance Consideration:** Ensure smooth scrolling, fast page loading, and efficient job filtering.
- **UI/UX Consideration:** The list should be easy to navigate, with clear, user-friendly job cards, and filters should be intuitive and accessible.

### Admin Users 🗣️

**Admin users should be able to:**
- Create companies.
- View all companies and the number of postings for each company.
- View a single company.
- Update a company.
- Delete a company and all of its postings.
- Create job postings for a selected company.
- View a single job posting.
- Update a job posting.
- Delete a job posting.
  
### Frontend Expectations 🤘

1. **Performance:**
   - **Optimize for Core Web Vitals (CWV):** Ensure the app scores well on metrics like First Contentful Paint (FCP), Largest Contentful Paint (LCP), and Cumulative Layout Shift (CLS).
   - **Lazy Loading:** Implement lazy loading of job postings and images to improve initial load time.
   - **Minification and Compression:** Minimize and compress assets (CSS, JS) for better performance.

2. **UI/UX:**
   - **Responsive Design:** Ensure the application is fully responsive across all devices (mobile, tablet, desktop).
   - **User-friendly Filters:** Implement an intuitive filtering UI with clear feedback when users apply filters.
   - **Microinteractions:** Add subtle animations or transitions to improve the user experience without impacting performance.
   - **Accessibility:** Ensure the site is accessible for all users (e.g., keyboard navigation, screen reader support).

3. **Frontend Architecture:**
   - **Reusable Components:** Build reusable components for job cards, filter options, and forms using Blade and Alpine.js.
   - **Separation of Concerns:** Ensure a clean separation between data fetching and UI rendering for scalability.
   - **CSS Architecture:** Use a CSS methodology such as BEM or utility-first CSS for maintainable and scalable styles.

4. **Extras (Optional but appreciated):**
   - **Dark Mode Toggle**: Provide a dark mode toggle for the job board.
   - **Hosting**: Deploy the application for extra points.

### Submission 📬

Please make sure to fork this repository and commit your code. We would like to see your commit history with clear, frequent commit messages. When you are completed with the challenge, feel free to share the repository link with us, along with a readme for getting started with the project. Ensure at least one commit is pushed at the 2-hour mark.
