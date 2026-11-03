# Videos

The home page no longer uses a video. Its "Inside the warehouse" section is an animated SVG drawn in `index.html` and styled in `assets/css/style.css` (the `wh-` classes).

## Grocery pack video (Variety Packs page)

Save a clip of grocery or snack items being packed as `grocery-pack.mp4`, plus `grocery-pack.webm` (needs ffmpeg):

    ffmpeg -i input.mp4 -t 20 -an -vf "scale=1280:-2" -c:v libx264 -crf 27 -preset slow -movflags +faststart grocery-pack.mp4
    ffmpeg -i grocery-pack.mp4 -c:v libvpx-vp9 -crf 38 -b:v 0 -an grocery-pack.webm

Once the MP4 is here it replaces the animated packing line at the top of the Variety Packs page.
