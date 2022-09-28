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

    function getUser(userID) {
        return $users.querySelector(`[data-id="${userID}"]`);
    }

    function removeUser(user) {
        const $user = getUser(user.id);
        if ($user) $user.remove();
    }

    function getUuid() {
        const url = new URL(window.location);
        return url.pathname.replace("/rooms/", "");
    }

    function handleRoomJoined(event) {
        if (!event.user) return;
        addUser(event.user);
    }

    function handleRoomLeft(event) {
        if (!event.user) return;
        removeUser(event.user);
    }

    function handleVoted(event) {
        if (! (event.user && event.vote)) return;
        const $user = getUser(event.user.id);
        if ($user) $user.classList.add("voted");
    }

    function reloadPage() {
        window.location.reload();
    }

    echo.private(`rooms.${uuid}`)
        .listen("RoomJoined", handleRoomJoined)
        .listen("RoomLeft", handleRoomLeft)
        .listen("Voted", handleVoted)
        .listen("VotingFinished", reloadPage)
        .listen("RoomReset", reloadPage);
}

main();
