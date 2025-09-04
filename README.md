# Rat Quotes

Imageboard that uploads files to a Cloudflare bucket and uses Discord for authentication. Made with Laravel and Livewire.

## To-Do
- [ ] Make the site prettier.
- [ ] Implement upvoting and downvoting functionality on the frontend.
    - The backend code is already implemented, see `User` and `Post` model for 
    the pivot table implementation of tracking votes, 
    as well the `upvote()` and `downvote()` function in Post 
    (may not be needed depending on how the rest of the full implementation 
    is carried out).
- [x] Give posts their own route.
- [ ] Add rich previews to make sharing posts nicer on Discord.
- [x] Give users also their own profile route to see their sumtotal points and 
all their posts in one.
