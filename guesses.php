<DOCTYPE html>
<html>
    <head>
        <title>My Guesses - Through The Keyhole</title>
        <script>
            function allowDrop(ev) {
                ev.preventDefault();
            }

            function drag(ev) {
                ev.dataTransfer.setData('text', ev.target.dataset.userId);
            }

            function drop(ev) {
                ev.preventDefault();
                const userId = ev.dataTransfer.getData('text');
                const userTab = document.querySelector('[data-user-id="' + userId + '"]');
                const imageBox = ev.target.closest('.image-box');
                imageBox.appendChild(userTab);
            }
        </script>
        <style>
            .user-choices {
                position: fixed;
                z-index: 1;
            }

            .user-choice {
                background-color: orange;
                border-radius: 3px;
                margin: 3px;
                padding: 3px;
                line-height: 1.5em;
                cursor: move;
            }

            .images {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;
            }

            .image-box {
                position: relative;
                margin-bottom: 15px;
            }

            .image-box img {
                width: 450px;
            }

            .image-box .user-choice {
                position: absolute;
                top: 3px;
                left: 3px;
            }
        </style>
    </head>
    <body>
        <div class="user-choices">
            <span class="user-choice" data-user-id="1" draggable="true" ondragstart="drag(event)">Simon</span>
            <span class="user-choice" data-user-id="2" draggable="true" ondragstart="drag(event)">Tyler</span>
            <span class="user-choice" data-user-id="3" draggable="true" ondragstart="drag(event)">Sam J</span>
            <span class="user-choice" data-user-id="4" draggable="true" ondragstart="drag(event)">Sam W</span>
            <span class="user-choice" data-user-id="5" draggable="true" ondragstart="drag(event)">Georgina</span>
            <span class="user-choice" data-user-id="6" draggable="true" ondragstart="drag(event)">Emma</span>
            <span class="user-choice" data-user-id="7" draggable="true" ondragstart="drag(event)">Callum</span>
        </div>
        <div class="images">
            <div data-submission-id="1" class="image-box" ondrop="drop(event)" ondragover="allowDrop(event)"><img src="https://i.imgur.com/4Sc5tMr.jpeg"></div>
            <div data-submission-id="2" class="image-box" ondrop="drop(event)" ondragover="allowDrop(event)"><img src="https://i.imgur.com/pbwJypD.jpeg"></div>
            <div data-submission-id="3" class="image-box" ondrop="drop(event)" ondragover="allowDrop(event)"><img src="https://i.imgur.com/r00eEi0.jpeg"></div>
            <div data-submission-id="4" class="image-box" ondrop="drop(event)" ondragover="allowDrop(event)"><img src="https://i.imgur.com/hS69MNK.jpeg"></div>
            <div data-submission-id="5" class="image-box" ondrop="drop(event)" ondragover="allowDrop(event)"><img src="https://i.imgur.com/EODbLbi.png"></div>
            <div data-submission-id="6" class="image-box" ondrop="drop(event)" ondragover="allowDrop(event)"><img src="https://i.imgur.com/4HxF1VJ.jpeg"></div>
            <div data-submission-id="7" class="image-box" ondrop="drop(event)" ondragover="allowDrop(event)"><img src="https://i.imgur.com/oG9GK1d.jpeg"></div>
            <div data-submission-id="8" class="image-box" ondrop="drop(event)" ondragover="allowDrop(event)"><img src="https://i.imgur.com/S3T6jPK.jpeg"></div>
            <div data-submission-id="9" class="image-box" ondrop="drop(event)" ondragover="allowDrop(event)"><img src="https://i.imgur.com/t8NTw9z.jpeg"></div>
            <div data-submission-id="10" class="image-box" ondrop="drop(event)" ondragover="allowDrop(event)"><img src="https://i.imgur.com/NrrM2rQ.jpeg"></div>
            <div data-submission-id="11" class="image-box" ondrop="drop(event)" ondragover="allowDrop(event)"><img src="https://i.imgur.com/ABQarUO.jpeg"></div>
            <div data-submission-id="12" class="image-box" ondrop="drop(event)" ondragover="allowDrop(event)"><img src="https://i.imgur.com/K435LuY.jpeg"></div>
            <div data-submission-id="13" class="image-box" ondrop="drop(event)" ondragover="allowDrop(event)"><img src="https://i.imgur.com/5ELr8OG.jpeg"></div>
            <div data-submission-id="14" class="image-box" ondrop="drop(event)" ondragover="allowDrop(event)"><img src="https://i.imgur.com/QeG9nBK.jpeg"></div>
        </div>
    </body>
</html>
