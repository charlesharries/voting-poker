import Echo from "laravel-echo";

/** @type {Echo} */
const echo = window.Echo;

function main() {
    const uuid = getUuid();
    const $users = document.getElementById("users");

    function addUser(user) {
        const $li = document.createElement("li");
        $li.setAttribute("data-id", user.id);
        $li.textContent = user.name;
        $users.appendChild($li);
    }

    function removeUser(user) {
        const $user = $users.querySelector(`[data-id="${user.id}"]`);
        $user.remove();
    }

    function getUuid() {
        const url = new URL(window.location);
        return url.pathname.replace("/rooms/", "");
    }

    function roomJoined(event) {
        if (!event.user) return;
        addUser(event.user);
    }

    function roomLeft(event) {
        if (!event.user) return;
        removeUser(event.user);
    }

    echo.private(`rooms.${uuid}`)
        .listen("RoomJoined", roomJoined)
        .listen("RoomLeft", roomLeft);
}

main();
