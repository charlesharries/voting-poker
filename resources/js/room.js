import Echo from "laravel-echo";
import { copyToClipboard } from "./copy";

/** @type {Echo} */
const echo = window.Echo;

function main() {
    const uuid = getUuid();
    const $users = document.getElementById("users");
    const $copyURL = document.getElementById("copyURL");

    function currentUserId() {
        const el = document.getElementById("current_user");
        if (!el) return null;
        return parseInt(el.dataset.userId, 10);
    }

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
        console.log(user.id, currentUserId())
        if (user.id === currentUserId()) {
            window.location.reload();
            return;
        }

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

    function handleUserKicked(event) {
        if (!event.user) reloadPage();
        removeUser(event.user);
    }

    function reloadPage() {
        window.location.reload();
    }

    async function copyURL() {
        await copyToClipboard(window.location.href);
        $copyURL.innerText = "Copied!";
        setTimeout(() => {
            $copyURL.innerText = "Copy room URL";
        }, 2000);
    }

    echo.private(`rooms.${uuid}`)
        .listen("RoomJoined", handleRoomJoined)
        .listen("RoomLeft", handleRoomLeft)
        .listen("Voted", handleVoted)
        .listen("VotingFinished", reloadPage)
        .listen("RoomReset", reloadPage)
        .listen("UserKicked", handleUserKicked);

    $copyURL.addEventListener("click", copyURL);

    // document.querySelectorAll(".boot").forEach(($el) => {
    //     $el.addEventListener("submit", (event) => {
    //         echo.private(`rooms.${uuid}`).stopListening("UserKicked");
    //     })
    // });
}

main();
