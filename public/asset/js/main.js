// add hovered class to selected list item
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));
// // Hapus kelas hovered dari elemen navigasi saat halaman dimuat
// window.onload = function() {
//   list.forEach((item) => {
//       item.classList.remove("hovered");
//   });
//   document.querySelector("a.active").parentNode.classList.add("hovered"); // Tambahkan kelas hovered ke navigasi 'Biaya'
// };


// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};
