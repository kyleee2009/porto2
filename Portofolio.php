<?php
session_start();
$error = "";
$hasil = false;
if (!empty($_POST)) {
  $pdo = require 'connection.php';
  $sql = "insert into contactme (nama, email, pesan) values (:nama, :email, :pesan)";
  $query = $pdo->prepare($sql);
  $query->execute(array(
    'nama' => $_POST['nama'],
    'email' => $_POST['email'],
    'pesan' => $_POST['pesan'],
  ));
  $_SESSION['success'] = "Your message has been sent, we'll contact you back as soon as possible, thank you so much!";
  header('location: Portofolio.php#contact');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Welcome!</title>

  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Exo+2:wght@300;400;600;700&display=swap" rel="stylesheet">


  <style>
    *,
    html {
      scroll-behavior: smooth;
    }

    ::-webkit-scrollbar {
      background-color: black;
    }

    ::-webkit-scrollbar-track {
      border-radius: 3px;
      background-color: transparent;
    }

    ::-webkit-scrollbar-thumb {
      border-radius: 5px;
      background-color: black;
      border: 2px solid cyan;
    }

    button {
      background-color: black;
      border: 2px solid cyan;
      color: white;
      border-radius: 10%;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: 'Exo 2', 'Orbitron', sans-serif;
      background: #0f1624;
      overflow-x: hidden;
      position: relative;
    }

    canvas {
      display: block;
      position: fixed;
      top: 0;
      left: 0;
      z-index: -1;
    }

    header {
      display: flex;
      align-items: center;
      flex-direction: column;
      position: relative;
    }

    .header {
      display: flex;
      top: 0 !important;
      justify-content: space-between;
      align-items: center;
      width: 100%;
      position: fixed !important;
      background: rgba(0, 0, 0, 0.95);
      backdrop-filter: blur(10px);
      color: cyan;
      z-index: 1001;
      padding: 5px 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
      height: 50px;
    }

    .Name,
    .title,
    .subtitle {
      font-family: 'Orbitron', sans-serif;
      font-weight: 700;
    }

    nav a,
    .aboutname,
    .prestasi {
      font-family: 'Orbitron', sans-serif;
      font-weight: 600;
    }

    h1,
    h2,
    h3 {
      font-family: 'Orbitron', sans-serif;
      font-weight: 700;
    }

    .Name {
      margin-left: 50px;
      color: white;
      animation: skittle 2s infinite;
      font-size: 1.5rem;
    }

    ol {
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      text-shadow: 1px 1px 20px lightblue;
    }

    ol>li {
      display: flex;
      align-items: center;
      text-align: center;
      justify-content: center;
      font-size: 16px;
      margin-left: 30px;
      margin-right: 30px;
    }

    nav a {
      text-decoration: none;
      color: cyan;
      transition: color 0.5s, transform 0.3s;
    }

    nav a:hover {
      color: white;
      animation: skittle 2s infinite;
    }

    section {
      padding: 20px;
      text-align: center;
      margin: 20px 0px;
      border-radius: 10px;
      color: white;
      scroll-margin-top: 60px;
    }

    .welcome-quote-container {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      margin: 0;
      padding: 0;
    }

    .title {
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      font-size: 75px;
      padding: 20px;
      animation: skittle 2s infinite;
      color: white;
      opacity: 1;
      transition: opacity 1s ease-out;
      margin: 0;
    }

    .subtitle {
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      font-size: 40px;
      color: white;
      margin: 0 0 20px 0;
      opacity: 1;
      transition: opacity 1s ease-out;
      animation: skittle 2s infinite;
    }

    .quote-container {
      display: none;
      justify-content: center;
      align-items: center;
      text-align: center;
      min-height: 200px;
      padding: 20px;
      opacity: 0;
      transition: opacity 1s ease-in;
    }

    .quote-text {
      font-family: 'Exo 2', sans-serif;
      font-weight: 300;
      letter-spacing: 0.5px;
      font-size: 32px;
      color: white;
      max-width: 800px;
      margin: 0 auto;
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 1.5s ease-in-out, transform 1.5s ease-out;
      animation: skittle 2s infinite;
    }

    .quote-text.active {
      opacity: 1;
      transform: translateY(0);
    }

    .quote-text.fade-out {
      opacity: 0;
      transform: translateY(-20px);
    }

    #about {
      height: auto;
      min-height: 100vh;
      padding: 40px 20px;
    }

    #about h2.aboutme {
      font-size: 50px;
      margin: 0 0 40px 0;
      padding: 0;
      animation: skittle 2s infinite;
      text-align: center;
    }

    #about h1 {
      font-size: 50px;
      margin: 0;
      padding: 0;
      animation: skittle 5s infinite;
    }

    #about p {
      font-size: 25px;
      animation: skittle 2s infinite;
    }

    #about img {
      border-radius: 50%;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.6);
      animation: float 3s ease-in-out infinite;
      height: 300px;
      width: 300px;
      object-fit: cover;
    }

    .about-container {
      display: flex;
      align-items: flex-start;
      justify-content: center;
      gap: 40px;
      max-width: 1200px;
      margin: 0 auto;
      flex-wrap: wrap;
    }

    .about-left {
      flex: 0 0 auto;
    }

    .about-right {
      flex: 1;
      max-width: 600px;
      min-width: 300px;
    }

    .description {
      margin: 0;
      max-width: none;
      border-radius: 10px;
      padding: 20px;
      background-color: transparent;
      box-shadow: none;
      width: auto;
      border: 2px solid transparent;
    }

    .aboutdesc {
      font-size: 1.2rem;
      line-height: 1.6;
      margin: 0;
      font-family: 'Exo 2', sans-serif;
      font-weight: 400;
      letter-spacing: 0.3px;
      text-align: justify;
    }

    @keyframes about {
      0% {
        text-shadow: 0 0 10px #00d9ff;
      }

      50% {
        text-shadow: 0 0 20px #00d9ff, 0 0 40px #00d9ff;
      }

      100% {
        text-shadow: 0 0 10px #00d9ff;
      }
    }

    @keyframes float {
      0% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-10px);
      }

      100% {
        transform: translateY(0);
      }
    }

    .aboutname {
      font-size: 2.5rem;
      margin: 0 0 10px 0;
      padding: 0;
      text-align: left;
      position: relative;
      display: inline-block;
      color: white;
      animation: glitch-shake 0.3s infinite;
    }

    .aboutname::before,
    .aboutname::after {
      content: "GUSANO DESEDA";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: inherit;
    }

    .aboutname::before {
      animation: glitch-tear-1 0.6s infinite linear alternate-reverse;
      color: #ff0040;
      z-index: -1;
      transform: translate(-2px, 0);
      clip-path: polygon(0 20%, 100% 20%, 100% 21%, 0 21%),
        polygon(0 40%, 100% 40%, 100% 43%, 0 43%),
        polygon(0 65%, 100% 65%, 100% 68%, 0 68%),
        polygon(0 85%, 100% 85%, 100% 88%, 0 88%);
    }

    .aboutname::after {
      animation: glitch-tear-2 0.4s infinite linear alternate-reverse;
      color: #00ffff;
      z-index: -2;
      transform: translate(2px, 0);
      clip-path: polygon(0 0%, 100% 0%, 100% 15%, 0 15%),
        polygon(0 30%, 100% 30%, 100% 35%, 0 35%),
        polygon(0 50%, 100% 50%, 100% 55%, 0 55%),
        polygon(0 75%, 100% 75%, 100% 80%, 0 80%),
        polygon(0 90%, 100% 90%, 100% 100%, 0 100%);
    }

    @keyframes glitch-shake {
      0% {
        transform: translate(0);
      }

      10% {
        transform: translate(-1px, -1px);
      }

      20% {
        transform: translate(1px, 1px);
      }

      30% {
        transform: translate(0);
      }

      40% {
        transform: translate(1px, -1px);
      }

      50% {
        transform: translate(-1px, 0);
      }

      60% {
        transform: translate(0);
      }

      70% {
        transform: translate(-1px, 1px);
      }

      80% {
        transform: translate(1px, 0);
      }

      90% {
        transform: translate(0);
      }

      100% {
        transform: translate(0);
      }
    }

    @keyframes glitch-tear-1 {
      0% {
        clip-path: polygon(0 2%, 100% 2%, 100% 5%, 0 5%),
          polygon(0 15%, 100% 15%, 100% 16%, 0 16%),
          polygon(0 35%, 100% 35%, 100% 40%, 0 40%),
          polygon(0 70%, 100% 70%, 100% 75%, 0 75%);
        transform: translate(-3px, 1px);
      }

      20% {
        clip-path: polygon(0 8%, 100% 8%, 100% 12%, 0 12%),
          polygon(0 25%, 100% 25%, 100% 30%, 0 30%),
          polygon(0 45%, 100% 45%, 100% 50%, 0 50%),
          polygon(0 80%, 100% 80%, 100% 85%, 0 85%);
        transform: translate(2px, -1px);
      }

      40% {
        clip-path: polygon(0 18%, 100% 18%, 100% 22%, 0 22%),
          polygon(0 32%, 100% 32%, 100% 38%, 0 38%),
          polygon(0 55%, 100% 55%, 100% 62%, 0 62%),
          polygon(0 88%, 100% 88%, 100% 95%, 0 95%);
        transform: translate(-1px, 2px);
      }

      60% {
        clip-path: polygon(0 5%, 100% 5%, 100% 9%, 0 9%),
          polygon(0 28%, 100% 28%, 100% 33%, 0 33%),
          polygon(0 48%, 100% 48%, 100% 53%, 0 53%),
          polygon(0 78%, 100% 78%, 100% 83%, 0 83%);
        transform: translate(1px, -2px);
      }

      80% {
        clip-path: polygon(0 12%, 100% 12%, 100% 17%, 0 17%),
          polygon(0 38%, 100% 38%, 100% 42%, 0 42%),
          polygon(0 62%, 100% 62%, 100% 68%, 0 68%),
          polygon(0 85%, 100% 85%, 100% 92%, 0 92%);
        transform: translate(-2px, 0);
      }

      100% {
        clip-path: polygon(0 0%, 100% 0%, 100% 3%, 0 3%),
          polygon(0 22%, 100% 22%, 100% 26%, 0 26%),
          polygon(0 42%, 100% 42%, 100% 47%, 0 47%),
          polygon(0 72%, 100% 72%, 100% 77%, 0 77%);
        transform: translate(0, 1px);
      }
    }

    @keyframes glitch-tear-2 {
      0% {
        clip-path: polygon(0 6%, 100% 6%, 100% 11%, 0 11%),
          polygon(0 26%, 100% 26%, 100% 31%, 0 31%),
          polygon(0 51%, 100% 51%, 100% 58%, 0 58%),
          polygon(0 81%, 100% 81%, 100% 88%, 0 88%);
        transform: translate(2px, -1px);
      }

      25% {
        clip-path: polygon(0 1%, 100% 1%, 100% 7%, 0 7%),
          polygon(0 19%, 100% 19%, 100% 24%, 0 24%),
          polygon(0 44%, 100% 44%, 100% 49%, 0 49%),
          polygon(0 74%, 100% 74%, 100% 79%, 0 79%),
          polygon(0 94%, 100% 94%, 100% 100%, 0 100%);
        transform: translate(-1px, 2px);
      }

      50% {
        clip-path: polygon(0 13%, 100% 13%, 100% 18%, 0 18%),
          polygon(0 33%, 100% 33%, 100% 39%, 0 39%),
          polygon(0 58%, 100% 58%, 100% 65%, 0 65%),
          polygon(0 88%, 100% 88%, 100% 95%, 0 95%);
        transform: translate(3px, 0);
      }

      75% {
        clip-path: polygon(0 9%, 100% 9%, 100% 14%, 0 14%),
          polygon(0 29%, 100% 29%, 100% 35%, 0 35%),
          polygon(0 54%, 100% 54%, 100% 61%, 0 61%),
          polygon(0 84%, 100% 84%, 100% 91%, 0 91%);
        transform: translate(-2px, -1px);
      }

      100% {
        clip-path: polygon(0 3%, 100% 3%, 100% 8%, 0 8%),
          polygon(0 23%, 100% 23%, 100% 28%, 0 28%),
          polygon(0 48%, 100% 48%, 100% 53%, 0 53%),
          polygon(0 78%, 100% 78%, 100% 83%, 0 83%),
          polygon(0 96%, 100% 96%, 100% 100%, 0 100%);
        transform: translate(1px, 1px);
      }
    }

    .aboutsubname {
      animation: skittle 2s infinite;
      min-height: 1.2em;
      position: relative;
      margin: 0 0 30px 0;
      text-align: center;
      font-size: 1.3rem;
    }

    .typing-text {
      overflow: hidden;
      border-right: 0.15em solid cyan;
      white-space: nowrap;
      margin: 0 auto;
      letter-spacing: 0.15em;
      animation: typing 3.5s steps(40, end), blink-caret 0.75s step-end infinite;
    }

    .typing-text.deleting {
      animation: deleting 2s steps(40, end), blink-caret 0.75s step-end infinite;
    }

    @keyframes typing {
      from {
        width: 0;
      }

      to {
        width: 100%;
      }
    }

    @keyframes deleting {
      from {
        width: 100%;
      }

      to {
        width: 0;
      }
    }

    @keyframes blink-caret {

      from,
      to {
        border-color: transparent;
      }

      50% {
        border-color: cyan;
      }
    }

    #skills h1 {
      animation: skittle 2s infinite;
      padding-bottom: 50px;
    }

    .skill {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      border-radius: 15px;
      padding: 30px 20px;
      margin: 0;
      width: 100%;
      max-width: 100px;
      height: 100px;
      background: rgba(255, 255, 255, 0.03);
      border: 1px solid rgba(0, 255, 242, 0.2);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .skill img {
      width: 30%;
    }

    .skill p {
      font-family: 'Exo 2', sans-serif;
      font-weight: 500;
    }

    .linkskill {
      text-decoration: none;
      color: white;
    }

    .skills-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 30px;
      padding: 40px 20px;
      max-width: 1200px;
      margin: 0 auto;
      position: relative;
    }

    .skills-container::before {
      content: '';
      position: absolute;
      top: -2px;
      left: -2px;
      right: -2px;
      bottom: -2px;
      background: linear-gradient(45deg, #00fff2, #0066ff, #00fff2, #0066ff);
      background-size: 400% 400%;
      border-radius: 20px;
      z-index: -2;
      animation: gradientShift 3s ease infinite;
    }

    .skills-container::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(15, 22, 36, 0.95);
      border-radius: 18px;
      z-index: -1;
    }

    @keyframes gradientShift {

      0%,
      100% {
        background-position: 0% 50%;
      }

      50% {
        background-position: 100% 50%;
      }
    }

    .skill::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(0, 255, 242, 0.1), transparent);
      transition: 0.5s;
    }

    .skill:hover::before {
      left: 100%;
    }

    .skill:hover {
      transform: translateY(-10px) scale(1.02);
      border-color: #00fff2;
      box-shadow: 0 0 30px rgba(0, 255, 242, 0.3), 0 10px 25px rgba(0, 0, 0, 0.4);
      background: rgba(255, 255, 255, 0.08);
    }

    .skill img {
      width: 80px;
      height: 80px;
      object-fit: contain;
      margin-bottom: 15px;
      filter: drop-shadow(0 0 10px rgba(0, 255, 242, 0.3));
      transition: all 0.3s ease;
    }

    .skill:hover img {
      transform: scale(1.1);
      filter: drop-shadow(0 0 15px rgba(0, 255, 242, 0.6));
    }

    .skill p {
      font-family: 'Exo 2', sans-serif;
      font-weight: 500;
      text-align: center;
      margin: 0;
      color: white;
      transition: color 0.3s ease;
    }

    .skill:hover p {
      color: #00fff2;
      text-shadow: 0 0 10px rgba(0, 255, 242, 0.5);
    }

    /* Glitch effect for skill names on hover */
    .skill:hover p {
      animation: textGlitch 0.3s ease-in-out;
    }

    @keyframes textGlitch {

      0%,
      100% {
        transform: translate(0);
      }

      20% {
        transform: translate(-1px, 1px);
      }

      40% {
        transform: translate(-1px, -1px);
      }

      60% {
        transform: translate(1px, 1px);
      }

      80% {
        transform: translate(1px, -1px);
      }
    }

    #achievements {
      padding: 40px 20px;
      margin: 100px 0;
    }

    .prestasi {
      font-size: 2.5em;
      margin-bottom: 40px;
      color: white;
      text-align: center;
      text-transform: uppercase;
      letter-spacing: 3px;
      animation: skittle 2s infinite;
    }

    .achievement-list {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      padding: 20px;
    }

    .achievement {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid #00fff220;
      border-radius: 15px;
      overflow: hidden;
      transition: all 0.3s;
      position: relative;
      cursor: pointer;
    }

    .achievement:hover {
      transform: translateY(-10px);
      border-color: #00fff2;
      box-shadow: 0 0 30px rgba(0, 255, 242, 0.2);
    }

    .achievement-image {
      height: 200px;
      background: linear-gradient(45deg, #000428, #004e92);
      position: relative;
      overflow: hidden;
    }

    .achievement-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s;
    }

    .achievement:hover .achievement-image img {
      transform: scale(1.05);
    }

    .achievement-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: repeating-linear-gradient(transparent 0%,
          rgba(0, 255, 242, 0.05) 0.5%,
          transparent 1%);
      animation: scan 5s linear infinite;
    }

    @keyframes scan {
      0% {
        transform: translateY(-50%);
      }

      100% {
        transform: translateY(0%);
      }
    }

    .achievement-content {
      padding: 20px;
    }

    .achievement h3 {
      color: #00fff2;
      margin-bottom: 15px;
      font-size: 1.5em;
    }

    .achievement p {
      color: #e0e0e0;
      margin-bottom: 15px;
      line-height: 1.6;
    }

    .achievement-tags {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 20px;
    }

    .achievement-tags span {
      background: rgba(0, 255, 242, 0.1);
      color: #00fff2;
      padding: 5px 15px;
      border-radius: 20px;
      font-size: 0.9em;
      border: 1px solid #00fff240;
    }

    .achievement-tags {
      display: none;
    }

    .achievement-metadata {
      display: flex;
      justify-content: space-between;
      align-items: center;
      color: #00fff2;
      font-size: 0.9em;
      margin-top: 10px;
    }

    .achievement-date {
      color: #e0e0e0;
    }

    .achievement a {
      display: inline-block;
      padding: 10px 25px;
      background: linear-gradient(45deg, #00fff2, #0066ff);
      color: #fff;
      text-decoration: none;
      border-radius: 20px;
      font-weight: bold;
      letter-spacing: 1px;
      transition: all 0.3s;
      position: relative;
      overflow: hidden;
      margin-top: 10px;
    }

    .achievement a::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg,
          transparent,
          rgba(255, 255, 255, 0.2),
          transparent);
      transition: 0.5s;
    }

    .achievement a:hover::before {
      left: 100%;
    }

    .achievement a:hover {
      transform: scale(1.05);
      box-shadow: 0 0 20px rgba(0, 255, 242, 0.5);
    }

    .achievement h3 {
      font-family: 'Orbitron', sans-serif;
      font-weight: 600;
    }

    .achievement p,
    .modal-description {
      font-family: 'Exo 2', sans-serif;
      font-weight: 400;
      letter-spacing: 0.2px;
    }

    .view-achievement {
      display: none;
    }

    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.9);
      z-index: 2000;
      backdrop-filter: blur(5px);
    }


    .modal-content {
      position: relative;
      background: rgba(10, 10, 10, 0.95);
      width: 80%;
      max-width: 700px;
      margin: 30px auto;
      padding: 25px;
      border-radius: 15px;
      border: 1px solid #00fff240;
      box-shadow: 0 0 50px rgba(0, 255, 242, 0.2);
      animation: modalFadeIn 0.3s ease-out;
      max-height: 85vh;
      overflow-y: auto;
    }

    @keyframes modalFadeIn {
      from {
        opacity: 0;
        transform: translateY(-50px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .close-modal {
      position: absolute;
      right: 20px;
      top: 20px;
      font-size: 30px;
      color: #00fff2;
      cursor: pointer;
      transition: all 0.3s;
      z-index: 2001;
    }

    .close-modal:hover {
      transform: rotate(90deg);
      color: #fff;
    }

    .modal-body {
      color: #e0e0e0;
    }

    .modal-body h2 {
      color: #00fff2;
      font-size: 2em;
      margin-bottom: 20px;
      text-align: center;
    }

    .modal-image {
      width: 100%;
      height: 300px;
      background: linear-gradient(45deg, #000428, #004e92);
      margin-bottom: 20px;
      border-radius: 10px;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .modal-image img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      object-position: center;
    }

    .modal-tags {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 20px;
    }

    .modal-tags span {
      background: rgba(0, 255, 242, 0.1);
      color: #00fff2;
      padding: 5px 15px;
      border-radius: 20px;
      font-size: 0.9em;
      border: 1px solid #00fff240;
    }

    .modal-description {
      margin-bottom: 30px;
      line-height: 1.6;
    }

    .modal-links {
      display: flex;
      gap: 20px;
      justify-content: center;
    }

    .modal-btn {
      padding: 10px 25px;
      background: linear-gradient(45deg, #00fff2, #0066ff);
      color: #fff;
      text-decoration: none;
      border-radius: 20px;
      font-weight: bold;
      letter-spacing: 1px;
      transition: all 0.3s;
      border: none;
      cursor: pointer;
    }

    .modal-btn:hover {
      transform: scale(1.05);
      box-shadow: 0 0 20px rgba(0, 255, 242, 0.5);
    }

    .modal-body h2 {
      font-family: 'Orbitron', sans-serif;
      font-weight: 700;
    }

    button,
    input,
    textarea,
    label {
      font-family: 'Exo 2', sans-serif;
      font-weight: 400;
    }

    #requirement {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      width: 100%;
      max-width: 300px;
    }

    label {
      margin-bottom: 8px;
      text-align: left;
      margin: 0 0 8px 0;
    }

    input,
    textarea {
      background: none;
      color: white;
      animation: skittle 2s infinite;
      border: 2px solid cyan;
      border-radius: 4px;
      padding: 8px 12px;
      width: 100%;
      outline: none;
    }

    input:focus,
    textarea:focus {
      border-color: white;
      box-shadow: 0 0 10px cyan;
    }

    textarea {
      resize: vertical;
      min-height: 100px;
    }

    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active,
    textarea:-webkit-autofill,
    textarea:-webkit-autofill:hover,
    textarea:-webkit-autofill:focus,
    textarea:-webkit-autofill:active {
      -webkit-background-clip: text;
      -webkit-text-fill-color: white !important;
      transition: background-color 5000s ease-in-out 0s;
      box-shadow: inset 0 0 20px 20px #0f1624;
    }

    .getintouch {
      margin-bottom: 50px;
      margin-top: 70px;
    }

    #Submit {
      margin-top: 20px;
      margin-bottom: 90px;
    }

    #contact {
      animation: skittle 2s infinite;
    }

    #contact h2 {
      padding-bottom: 50px;
    }

    .contacticon {
      width: 50px;
      height: 50px;
      filter: brightness(0) invert(1);
      transition: transform 0.3s ease-out, filter 0.3s ease-in-out,
        opacity 0.8s ease-out;
    }

    .contacticon:hover {
      cursor: pointer;
      transform: scale(1.2);
      filter: brightness(0) invert(0) drop-shadow(0 0 10px cyan);
      -webkit-transform: scale(1.2);
    }

    section {
      padding: 20px;
      text-align: center;
      margin: 20px 0px;
      border-radius: 10px;
      color: white;
      scroll-margin-top: 60px;
    }

    footer {
      text-align: center;
      background-color: rgba(0, 0, 0, 0.8);
      position: relative;
      bottom: 0;
      width: 100%;
      color: white;
      padding: 1px;
    }

    @keyframes skittle {
      0% {
        text-shadow: 0 0 0 cyan;
      }

      50% {
        text-shadow: 0 0 10px cyan;
      }

      100% {
        text-shadow: 0 0 0 cyan;
      }
    }

    .sukses {
      color: green;
    }

    .gagal {
      color: red;
    }
  </style>
</head>

<body>
  <canvas id="background"></canvas>

  <!-- Navigation -->
  <header>
    <div class="header">
      <h1 class="Name">StallPlayz</h1>
      <nav class="link">
        <ol>
          <li><a href="#home">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#skills">Skills</a></li>
          <li><a href="#achievements">Projects</a></li>
          <li><a href="#contact">Contacts</a></li>
        </ol>
      </nav>
    </div>
  </header>

  <!-- Home -->
  <div id="home">
    <div class="welcome-quote-container">
      <h1 class="title" data-aos="fade-up" data-aos-duration="1500">Welcome</h1>
      <h2 class="subtitle" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="200">To my portfolio</h2>
      <div class="quote-container">
        <p class="quote-text"></p>
      </div>
    </div>
  </div>

  <!-- About -->
  <section id="about">
    <h2 class="aboutme" data-aos="fade-up" data-aos-duration="1000">About Me</h2>

    <div class="about-container">
      <div class="about-left">
        <img src="/porto/src img/Saya.jpg" alt="" width="300" class="aboutimg" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="200" />
      </div>

      <div class="about-right">
        <h1 class="aboutname" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">GUSANO DESEDA</h1>
        <h2 class="aboutsubname" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">Newbie Programmer | Gamer | Rookie Game Dev</h2>

        <div class="description" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="800">
          <p class="aboutdesc">
            Hello! I'm a passionate developer with a love for creating beautiful and functional web applications. Making a lovely and engaging game is also my priority. I enjoy learning new technologies and improving my skills.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Skills -->
  <section id="skills">
    <h1 class="myskill" data-aos="fade-up" data-aos-duration="1000">My Skills</h1>
    <div class="skills-container" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
      <a href="https://html.com" target="_blank" class="linkskill">
        <div class="skill" data-aos="flip-left" data-aos-duration="1000" data-aos-delay="100">
          <img src="/porto/src img/html.png" alt="" />
          <p>HTML</p>
        </div>
      </a>
      <div class="skills-container" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
        <a href="https://www.w3.org/Style/CSS/Overview.en.html" target="_blank" class="linkskill">
          <div class="skill" data-aos="flip-left" data-aos-duration="1000" data-aos-delay="100">
            <img src="/porto/src img/css.png" alt="" />
            <p>CSS</p>
          </div>
        </a>
        <div class="skills-container" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
          <a href="https://javascript.com" target="_blank" class="linkskill">
            <div class="skill" data-aos="flip-left" data-aos-duration="1000" data-aos-delay="100">
              <img src="/porto/src img/javascript.png" alt="" />
              <p>JavaScript</p>
            </div>
          </a>
          <div class="skills-container" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
            <a href="https://cplusplus.com" target="_blank" class="linkskill">
              <div class="skill" data-aos="flip-left" data-aos-duration="1000" data-aos-delay="100">
                <img src="/porto/src img/C++.png" alt="" />
                <p>C++</p>
              </div>
            </a>
            <div class="skills-container" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
              <a href="https://www.minecraft.net/en-us" target="_blank" class="linkskill">
                <div class="skill" data-aos="flip-left" data-aos-duration="1000" data-aos-delay="100">
                  <img src="/porto/src img/minecraft.png" alt="" />
                  <p>Minecraft</p>
                </div>
              </a>
              <div class="skills-container" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <a href="https://www.sekirothegame.com" target="_blank" class="linkskill">
                  <div class="skill" data-aos="flip-left" data-aos-duration="1000" data-aos-delay="100">
                    <img src="/porto/src img/sekiro.png" alt="" />
                    <p>Sekiro : Shadow Die Twice</p>
                  </div>
                </a>
                <div class="skills-container" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                  <a href="https://en.bandainamcoent.eu/dark-souls/dark-souls-iii" target="_blank" class="linkskill">
                    <div class="skill" data-aos="flip-left" data-aos-duration="1000" data-aos-delay="100">
                      <img src="/porto/src img/ds3.png" alt="" />
                      <p>Dark Souls III</p>
                    </div>
                  </a>
                  <div class="skills-container" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <a href="https://www.factorio.com" target="_blank" class="linkskill">
                      <div class="skill" data-aos="flip-left" data-aos-duration="1000" data-aos-delay="100">
                        <img src="/porto/src img/factorio.png" alt="" />
                        <p>Factorio</p>
                      </div>
                    </a>
  </section>

  <section id="achievements">
    <h2 class="prestasi" data-aos="fade-up" data-aos-duration="1000">Achievements & Projects</h2>
    <div class="achievement-list">
      <!-- Achievement Cards -->
      <div class="achievement"
        data-title="Mini Course Basic Programming Certificate"
        data-description="[EternityUniv & JavaArch] Mini Course Basic Programming : HTML, CSS, JS Completion Certificate. This certificate validates my foundational knowledge in web development technologies including HTML markup, CSS styling, and JavaScript programming."
        data-image="/porto/src img/Sertifikat Mini Course.jpg"
        data-tags="HTML,CSS,JavaScript,Web Development"
        data-date="08 January 2025"
        data-type="certificate"
        data-aos="fade-up"
        data-aos-duration="1000"
        data-aos-delay="100">
        <div class="achievement-image">
          <div class="achievement-overlay"></div>
          <img src="/porto/src img/Sertifikat Mini Course.jpg" alt="Mini Course Certificate" />
        </div>
        <div class="achievement-content">
          <h3>Achievement 1</h3>
          <p>[EternityUniv & JavaArch] Mini Course Basic Programming : HTML, CSS, JS Completion Certificate</p>
          <div class="achievement-tags">
            <span>HTML</span>
            <span>CSS</span>
            <span>JavaScript</span>
          </div>
        </div>
      </div>

      <div class="achievement"
        data-title="Level 1 Programming Course"
        data-description="Level 1 Programming Course Completion Certificate. This foundational course covered basic programming concepts, problem-solving techniques, and introductory software development principles."
        data-image="/porto/src img/Sertifikat Kursus 3.jpg"
        data-tags="Programming,Fundamentals,Software Development"
        data-date="28 September 2024"
        data-type="certificate"
        data-aos="fade-up"
        data-aos-duration="1000"
        data-aos-delay="200">
        <div class="achievement-image">
          <div class="achievement-overlay"></div>
          <img src="/porto/src img/Sertifikat Kursus 3.jpg" alt="Level 1 Programming Certificate" />
        </div>
        <div class="achievement-content">
          <h3>Achievement 2</h3>
          <p>Level 1 Programming Course Completion Certificate</p>
          <div class="achievement-tags">
            <span>Programming</span>
            <span>Fundamentals</span>
          </div>
        </div>
      </div>

      <div class="achievement"
        data-title="Level 2 Programming Course"
        data-description="Level 2 Programming Course Completion Certificate. Advanced programming concepts including data structures, algorithms, object-oriented programming, and advanced problem-solving techniques."
        data-image="/porto/src img/Sertifikat Kursus 1.jpg"
        data-tags="Advanced Programming,Data Structures,Algorithms,OOP"
        data-date="30 November 2024"
        data-type="certificate"
        data-aos="fade-up"
        data-aos-duration="1000"
        data-aos-delay="300">
        <div class="achievement-image">
          <div class="achievement-overlay"></div>
          <img src="/porto/src img/Sertifikat Kursus 1.jpg" alt="Level 2 Programming Certificate" />
        </div>
        <div class="achievement-content">
          <h3>Achievement 3</h3>
          <p>Level 2 Programming Course Completion Certificate</p>
          <div class="achievement-tags">
            <span>Advanced Programming</span>
            <span>Algorithms</span>
          </div>
        </div>
      </div>

      <div class="achievement"
        data-title="CAGAK Event Certificate"
        data-description="[CAGAK Event (Calon Penegak)] with a theme 'Improve Knowledge as a Provision For The Journey'. This scouting event focused on leadership development, outdoor skills, and character building through various challenges and activities."
        data-image="/porto/src img/Sertifikat Cagak.jpg"
        data-tags="Leadership,Scouting,Character Building,Outdoor Skills"
        data-date="15 December 2024"
        data-type="certificate"
        data-aos="fade-up"
        data-aos-duration="1000"
        data-aos-delay="400">
        <div class="achievement-image">
          <div class="achievement-overlay"></div>
          <img src="/porto/src img/Sertifikat Cagak.jpg" alt="CAGAK Event Certificate" />
        </div>
        <div class="achievement-content">
          <h3>Achievement 4</h3>
          <p>[CAGAK Event (Calon Penegak)] with a theme ("Improve Knowledge as a Provision For The Journey")</p>
          <div class="achievement-tags">
            <span>Leadership</span>
            <span>Scouting</span>
          </div>
        </div>
      </div>

      <div class="achievement"
        data-title="Global Game Jam 2025"
        data-description="[GLOBAL GAME JAM SURABAYA 2025] Making A Game Using A Theme 'Bubble'. Participated in the world's largest game jam event, collaborating with a team to create an innovative game within 48 hours using the theme 'Bubble'."
        data-image="/porto/src img/Sertifikat GGJ.jpg"
        data-tags="Game Development,Unity,Game Jam,Team Collaboration"
        data-date="26 January 2025"
        data-type="certificate"
        data-aos="fade-up"
        data-aos-duration="1000"
        data-aos-delay="500">
        <div class="achievement-image">
          <div class="achievement-overlay"></div>
          <img src="/porto/src img/Sertifikat GGJ.jpg" alt="Global Game Jam Certificate" />
        </div>
        <div class="achievement-content">
          <h3>Achievement 5</h3>
          <p>[GLOBAL GAME JAM SURABAYA 2025] Making A Game Using A Theme "Bubble"</p>
          <div class="achievement-tags">
            <span>Game Development</span>
            <span>Unity</span>
            <span>Game Jam</span>
          </div>
        </div>
      </div>

      <div class="achievement"
        data-title="TOEIC Certificate"
        data-description="[Test Of English For International Communication] TOEIC Certificate. This internationally recognized English proficiency test validates communication skills in English for professional and academic environments, demonstrating competency in listening, reading, speaking, and writing."
        data-image="/porto/src img/Sertifikat TOEIC.jpg"
        data-tags="English Proficiency,TOEIC,International Communication,Language Skills"
        data-date="6 March 2025"
        data-type="certificate"
        data-aos="fade-up"
        data-aos-duration="1000"
        data-aos-delay="500">
        <div class="achievement-image">
          <div class="achievement-overlay"></div>
          <img src="/porto/src img/Sertifikat TOEIC.jpg" alt="TOEIC Certificate" />
        </div>
        <div class="achievement-content">
          <h3>Achievement 6</h3>
          <p>[Test Of English For International Communication] TOEIC Certificate</p>
          <div class="achievement-tags">
            <span>English Proficiency</span>
            <span>TOEIC</span>
            <span>International Communication</span>
          </div>
        </div>
      </div>

      <!-- Project Cards -->
      <div class="achievement"
        data-title="Unexpected Hero - Scratch Game"
        data-description="A simple but engaging Scratch-based game featuring adventure elements and creative gameplay mechanics. Built using Scratch's visual programming interface, this game demonstrates fundamental game design principles and interactive storytelling."
        data-image="/porto/src img/Unexpected Hero.JPG"
        data-tags="Scratch,Game Design,Interactive Media,Programming"
        data-date="11 September 2024"
        data-demo="https://scratch.mit.edu/projects/1117716683"
        data-type="project"
        data-aos="fade-up"
        data-aos-duration="1000"
        data-aos-delay="600">
        <div class="achievement-image">
          <div class="achievement-overlay"></div>
          <img src="/porto/src img/Unexpected Hero.JPG" alt="Unexpected Hero Game" />
        </div>
        <div class="achievement-content">
          <h3>Project 1</h3>
          <p>Unexpected Hero : A simple Scratch Game</p>
          <div class="achievement-tags">
            <span>Scratch</span>
            <span>Game Design</span>
            <span>Interactive Media</span>
          </div>
        </div>
      </div>

      <div class="achievement"
        data-title="Bomb Game - C++ Minesweeper"
        data-description="A C++ remake of the classic Minesweeper game featuring custom algorithms, console-based interface, and enhanced gameplay mechanics. This project demonstrates proficiency in C++ programming, data structures, and game logic implementation."
        data-image="/porto/src img/Minesweeper.jpg"
        data-tags="C++,Game Development,Console Application,Algorithms"
        data-date="11 November 2024"
        data-demo="https://github.com/StallPlayz/Bomb-Game"
        data-type="project"
        data-aos="fade-up"
        data-aos-duration="1000"
        data-aos-delay="700">
        <div class="achievement-image">
          <div class="achievement-overlay"></div>
          <img src="/porto/src img/Minesweeper.jpg" alt="Bomb Game Minesweeper" />
        </div>
        <div class="achievement-content">
          <h3>Project 2</h3>
          <p>[Bomb Game] A simple C++ remake of Minesweeper</p>
          <div class="achievement-tags">
            <span>C++</span>
            <span>Game Development</span>
            <span>Algorithms</span>
          </div>
        </div>
      </div>

      <div class="achievement"
        data-title="Full Calculator - C++ Application"
        data-description="A comprehensive C++ calculator application featuring advanced mathematical functions including trigonometric operations (Sin, Cos, Tan), exponential calculations, logarithms, and more. Built with robust error handling and user-friendly interface."
        data-image="/porto/src img/Calculator.jpg"
        data-tags="C++,Mathematics,Console Application,Advanced Functions"
        data-date="15 November 2024"
        data-demo="https://github.com/StallPlayz/Full-Calculator"
        data-type="project"
        data-aos="fade-up"
        data-aos-duration="1000"
        data-aos-delay="800">
        <div class="achievement-image">
          <div class="achievement-overlay"></div>
          <img src="/porto/src img/Calculator.jpg" alt="Full Calculator" />
        </div>
        <div class="achievement-content">
          <h3>Project 3</h3>
          <p>A C++ Based Full Calculator (Including Sin Cos Tan, Power, Logarithm, and more)</p>
          <div class="achievement-tags">
            <span>C++</span>
            <span>Mathematics</span>
            <span>Advanced Functions</span>
          </div>
        </div>
      </div>

      <div class="achievement"
        data-title="GGJ Game - Mr.Soap vs Flying Cans"
        data-description="A fun and engaging game developed during Global Game Jam 2025, featuring Mr.Soap in an epic battle against flying cans with creative gameplay mechanics and polished visuals."
        data-image="/porto/src img/GGJ Game.JPG"
        data-tags="Game Development,Unity,C#,Global Game Jam,2D Platformer"
        data-date="26 January 2025"
        data-demo="https://github.com/MrAdrocatis/GGJ25-Kelompok14.git"
        data-type="project"
        data-aos="fade-up"
        data-aos-duration="1000"
        data-aos-delay="800">
        <div class="achievement-image">
          <div class="achievement-overlay"></div>
          <img src="/porto/src img/GGJ Game.JPG" alt="GGJ Game" />
        </div>
        <div class="achievement-content">
          <h3>Project 4</h3>
          <p>[GGJ Game] Mr.Soap vs Flying Cans</p>
          <div class="achievement-tags">
            <span>Game Development</span>
            <span>Unity</span>
            <span>Global Game Jam</span>
          </div>
        </div>
      </div>

      <div class="achievement"
        data-title="Crow's Souls - Game Cover Design"
        data-description="Original game cover design created using Figma for a fictional game called 'Crow's Souls'. This design project showcases creative skills in digital art, typography, and visual composition using properly licensed assets and resources."
        data-image="/porto/src img/MyOwnGameCover.jpg"
        data-tags="Figma,Graphic Design,Game Art,Visual Design"
        data-date="15 October 2024"
        data-type="design"
        data-aos="fade-up"
        data-aos-duration="1000"
        data-aos-delay="900">
        <div class="achievement-image">
          <div class="achievement-overlay"></div>
          <img src="/porto/src img/MyOwnGameCover.jpg" alt="Crow's Souls Game Cover" />
        </div>
        <div class="achievement-content">
          <h3>Design 1</h3>
          <p>A Game Cover Design : Crow's Souls (originally by me, made with figma) [assets are free and everything has a license]</p>
          <div class="achievement-tags">
            <span>Figma</span>
            <span>Graphic Design</span>
            <span>Game Art</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Modal for Achievement/Project Details -->
  <div class="modal" id="achievementModal">
    <div class="modal-content">
      <span class="close-modal">&times;</span>
      <div class="modal-body">
        <h2 id="modalTitle">Achievement Title</h2>
        <div class="modal-image" id="modalImageContainer">
          <!-- Achievement/Project image will be loaded here -->
        </div>
        <div class="modal-tags" id="modalTags">
          <!-- Tags will be loaded here -->
        </div>
        <div class="modal-description" id="modalDescription">
          <!-- Description will be loaded here -->
        </div>
        <div class="modal-links" id="modalLinks">
          <!-- Links will be loaded here based on type -->
        </div>
      </div>
    </div>
  </div>

  <section id="contact">
    <div class="input" data-aos="fade-up" data-aos-duration="1000">
      <div id="Site" class="Site">
        <form class="Login_Site" action="" method="POST">
          <h1 class="getintouch" data-aos="fade-up" data-aos-duration="1000">Get In Touch With Me</h1>

          <?php
          if (isset($_SESSION['success'])) {
            echo "<p class='text-success'>" . $_SESSION['success'] . "</p>";
            unset($_SESSION['success']);
          }
          ?>

          <?php if ($error != '') {
            echo '<p class="text-danger">' . $error . '</p>';
          } ?>

          <!-- Kirim Pesan -->
          <div id="requirement">
            <div class="form-group" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
              <label for="name">Name:</label>
              <input id="name" type="text" placeholder="Your name, Please!" name="nama" autocomplete="on" required />
            </div>

            <div class="form-group" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="400">
              <label for="email">Email:</label>
              <input id="email" type="email" placeholder="So I can contact you back" name="email" autocomplete="on"
                required />
            </div>

            <div class="form-group" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
              <label for="message">Your message:</label>
              <textarea name="pesan" id="message" cols="30" rows="10" placeholder="What's on your mind today?"
                autocapitalize="on" required></textarea>
            </div>
          </div>
          <div>
            <button id="Submit" type="submit" name="kirim" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="800">Send</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Contact Me -->
    <h2 class="contacttitle" data-aos="fade-up" data-aos-duration="1000">Contact Me</h2>

    <ol data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
      <li data-aos="zoom-in" data-aos-duration="800" data-aos-delay="300">
        <a href="mailto:stallplayz123@gmail.com" target="_blank">
          <img src="/porto/src img/Email.png" class="contacticon" alt="Email" /></a>
      </li>
      <li data-aos="zoom-in" data-aos-duration="800" data-aos-delay="400">
        <a href="https://api.whatsapp.com/send?phone=62859183982879" target="_blank">
          <img src="/porto/src img/Whatsapp.png" class="contacticon" alt="Whatsapp" /></a>
      </li>
      <li data-aos="zoom-in" data-aos-duration="800" data-aos-delay="500">
        <a href="https://www.youtube.com/@StallPlayz" target="_blank">
          <img src="/porto/src img/Youtube.png" class="contacticon" alt="YouTube" />
        </a>
      </li>
      <li data-aos="zoom-in" data-aos-duration="800" data-aos-delay="600">
        <a href="https://www.instagram.com/stallplayz._.101" target="_blank">
          <img src="/porto/src img/Instagram.png" class="contacticon" alt="Instagram" />
        </a>
      </li>
      <li data-aos="zoom-in" data-aos-duration="800" data-aos-delay="700">
        <a href="https://github.com/StallPlayz" target="_blank">
          <img src="/porto/src img/GitHub.png" class="contacticon" alt="GitHub" />
        </a>
      </li>
      <li data-aos="zoom-in" data-aos-duration="800" data-aos-delay="800">
        <a href="https://www.tiktok.com/@stallplayz" target="_blank">
          <img src="/porto/src img/Tiktok.png" class="contacticon" alt="Tiktok" />
        </a>
      </li>
      <li data-aos="zoom-in" data-aos-duration="800" data-aos-delay="900">
        <a href="https://x.com/stallplayz123" target="_blank">
          <img src="/porto/src img/Twitter.png" class="contacticon" alt="Twitter" />
        </a>
      </li>
    </ol>
  </section>

  <!-- Copyright -->
  <footer data-aos="fade-up" data-aos-duration="1000">
    <p>&copy; 2025 StallPlayz. All rights reserved.</p>
  </footer>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    // Animated subtitle functionality for aboutsubname
    function initAnimatedSubtitle() {
      const subtitleElement = document.querySelector('.aboutsubname');
      const titles = [
        'Rookie Game Dev',
        'Newbie Programmer',
        'Gamer',
        'Student'
      ];

      let currentIndex = 0;
      let currentText = '';
      let isDeleting = false;
      let typeSpeed = 100; // Typing speed in milliseconds
      let deleteSpeed = 50; // Deleting speed in milliseconds
      let pauseTime = 2000; // Pause time between words in milliseconds

      function typeWriter() {
        const fullText = titles[currentIndex];

        if (isDeleting) {
          // Remove characters
          currentText = fullText.substring(0, currentText.length - 1);
          typeSpeed = deleteSpeed;
        } else {
          // Add characters
          currentText = fullText.substring(0, currentText.length + 1);
          typeSpeed = 100 + Math.random() * 100; // Add some randomness to typing speed
        }

        // Update the element text with cursor
        subtitleElement.innerHTML = currentText + '<span class="typing-cursor">|</span>';

        // Check if word is complete
        if (!isDeleting && currentText === fullText) {
          // Pause before starting to delete
          setTimeout(() => {
            isDeleting = true;
            typeWriter();
          }, pauseTime);
          return;
        }

        // Check if word is completely deleted
        if (isDeleting && currentText === '') {
          isDeleting = false;
          currentIndex = (currentIndex + 1) % titles.length; // Move to next title
          setTimeout(typeWriter, 500); // Small pause before typing next word
          return;
        }

        // Continue typing/deleting
        setTimeout(typeWriter, typeSpeed);
      }

      // Start the animation
      typeWriter();
    }

    // Add CSS for the typing cursor (add this to your existing CSS)
    const cursorStyle = `
.typing-cursor {
  color: cyan;
  animation: blink 1s infinite;
}

@keyframes blink {
  0%, 50% { opacity: 1; }
  51%, 100% { opacity: 0; }
}
`;

    // Inject the cursor CSS
    const styleSheet = document.createElement('style');
    styleSheet.textContent = cursorStyle;
    document.head.appendChild(styleSheet);

    // Initialize when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
      // Wait a bit for AOS animations to settle, then start the typing animation
      setTimeout(initAnimatedSubtitle, 1000);
    });
    // Initialize AOS
    AOS.init({
      duration: 1000,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });

    // Quote rotation functionality (existing code)
    const quotes = [{
        text: "The only way to do great work is to love what you do.",
        author: "Steve Jobs",
      },
      {
        text: "Everything is designed, but few things are designed well.",
        author: "Brian Reed",
      },
      {
        text: "Programming isn't about what you know; it's about what you can figure out.",
        author: "Chris Pine",
      },
      {
        text: "The best way to predict the future is to create it.",
        author: "Peter Drucker",
      },
      {
        text: "Code is like humor. When you have to explain it, it's bad.",
        author: "Cory House",
      },
      {
        text: "Simplicity is the soul of efficiency.",
        author: "Austin Freeman",
      },
      {
        text: "Make it work, make it right, make it fast.",
        author: "Kent Beck",
      },
      {
        text: "Clean code always looks like it was written by someone who cares.",
        author: "Robert C. Martin",
      },
      {
        text: "The best error message is the one that never shows up.",
        author: "Thomas Fuchs",
      },
      {
        text: "The function of good software is to make the complex appear to be simple.",
        author: "Grady Booch",
      },
    ];

    function handleWelcomeTransition() {
      setTimeout(() => {
        document.querySelector(".title").style.opacity = "0";
        document.querySelector(".subtitle").style.opacity = "0";

        setTimeout(() => {
          document.querySelector(".title").style.display = "none";
          document.querySelector(".subtitle").style.display = "none";
          document.querySelector(".quote-container").style.display = "flex";

          setTimeout(() => {
            document.querySelector(".quote-container").style.opacity = "1";
            startQuoteRotation();
          }, 100);
        }, 1000);
      }, 3000);
    }

    function startQuoteRotation() {
      const quoteElement = document.querySelector(".quote-text");
      let currentIndex = 0;

      function updateQuote() {
        quoteElement.classList.add("fade-out");
        quoteElement.classList.remove("active");

        setTimeout(() => {
          const quote = quotes[currentIndex];
          quoteElement.innerHTML = `${quote.text}<br><br><em>- ${quote.author}</em>`;

          quoteElement.classList.remove("fade-out");
          void quoteElement.offsetWidth;
          quoteElement.classList.add("active");

          currentIndex = (currentIndex + 1) % quotes.length;
        }, 1500);
      }

      const firstQuote = quotes[currentIndex];
      quoteElement.innerHTML = `${firstQuote.text}<br><br><em>- ${firstQuote.author}</em>`;
      currentIndex = (currentIndex + 1) % quotes.length;

      setTimeout(() => {
        quoteElement.classList.add("active");
      }, 100);

      setInterval(updateQuote, 7000);
    }

    window.addEventListener("load", handleWelcomeTransition);

    // Modal functionality for achievements/projects - Updated to make entire card clickable
    const modal = document.getElementById('achievementModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalTags = document.getElementById('modalTags');
    const modalDescription = document.getElementById('modalDescription');
    const modalImageContainer = document.getElementById('modalImageContainer');
    const modalLinks = document.getElementById('modalLinks');
    const closeModal = document.querySelector('.close-modal');

    // Add click event to all achievement/project cards (entire card is now clickable)
    document.querySelectorAll('.achievement').forEach(card => {
      card.addEventListener('click', function(e) {
        // Prevent modal from opening if a link inside the card is clicked
        if (e.target.tagName === 'A') {
          return;
        }

        // Get data from card
        const title = this.dataset.title;
        const description = this.dataset.description;
        const tags = this.dataset.tags ? this.dataset.tags.split(',') : [];
        const demo = this.dataset.demo;
        const date = this.dataset.date;
        const image = this.dataset.image;
        const type = this.dataset.type;

        // Update modal content
        modalTitle.textContent = title;
        modalDescription.textContent = description;
        modalTags.innerHTML = tags.map(tag => `<span>${tag.trim()}</span>`).join('');

        if (image) {
          modalImageContainer.innerHTML = `<img src="${image}" alt="${title}">`;
        }

        // Create appropriate links based on type
        let linksHTML = '';
        if (type === 'project' && demo) {
          if (demo.includes('github.com')) {
            linksHTML = `<a href="${demo}" class="modal-btn" target="_blank">View Source Code</a>`;
          } else {
            linksHTML = `<a href="${demo}" class="modal-btn" target="_blank">Try Project</a>`;
          }
        } else if (type === 'certificate') {
          linksHTML = `<span class="modal-btn" style="background: rgba(0,255,242,0.2); cursor: default;">Completed: ${date}</span>`;
        } else if (type === 'design') {
          linksHTML = `<span class="modal-btn" style="background: rgba(0,255,242,0.2); cursor: default;">Created: ${date}</span>`;
        }

        modalLinks.innerHTML = linksHTML;

        // Show modal
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
      });
    });

    // Close modal when clicking X
    closeModal.addEventListener('click', () => {
      modal.style.display = 'none';
      document.body.style.overflow = 'auto';
    });

    // Close modal when clicking outside
    window.addEventListener('click', (event) => {
      if (event.target === modal) {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
      }
    });

    // Background animation (existing code)
    const canvas = document.getElementById("background");
    const ctx = canvas.getContext("2d");

    let width, height;

    function resize() {
      width = canvas.width = window.innerWidth;
      height = canvas.height = window.innerHeight;
    }
    window.addEventListener("resize", resize);
    resize();

    const particleColors = [
      "rgba(130, 207, 224, 0.9)",
      "rgba(100, 140, 180, 0.85)",
      "rgba(60, 80, 120, 0.8)",
      "rgba(80, 60, 140, 0.85)",
      "rgba(90, 90, 160, 0.8)",
      "rgba(170, 30, 150, 0.8)",
      "rgba(90, 20, 60, 0.7)",
    ];

    function createParticle(initial = false) {
      const speed = Math.random() * 0.6 + 0.3;
      const angle = Math.PI * 1.25;
      const margin = 60;
      const radius = Math.random() * 3 + 1.5;
      let x, y;
      let color = particleColors[Math.floor(Math.random() * particleColors.length)];
      let glow = Math.random() * 40 + 40;
      if (color.includes("170, 30, 150")) glow *= 1.3;

      if (initial) {
        x = Math.random() * width;
        y = Math.random() * height;
      } else {
        const edge = Math.random();
        if (edge < 0.5) {
          x = Math.random() * (width + margin);
          y = height + Math.random() * margin;
        } else {
          x = width + Math.random() * margin;
          y = Math.random() * (height + margin);
        }
      }

      return {
        x,
        y,
        radius,
        dx: Math.cos(angle) * speed,
        dy: Math.sin(angle) * speed,
        color,
        glow
      };
    }

    let particles = Array.from({
      length: 50
    }, () => createParticle(true));

    function updateParticles() {
      particles.forEach((p, i) => {
        p.x += p.dx;
        p.y += p.dy;
        if (p.x < -60 || p.y < -60) particles[i] = createParticle(false);
      });
    }

    function drawParticles() {
      particles.forEach((p) => {
        ctx.beginPath();
        ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
        ctx.fillStyle = p.color;
        ctx.shadowBlur = p.glow;
        ctx.shadowColor = p.color;
        ctx.fill();
      });
    }

    const starColors = [
      "rgba(0, 255, 255, 1)",
      "rgba(0, 200, 255, 1)",
      "rgba(180, 0, 255, 1)",
      "rgba(255, 0, 200, 1)",
      "rgba(80, 150, 255, 1)",
    ];

    function createStar(offscreen = false) {
      const radius = Math.random() * 1.5 + 0.3;
      const margin = 50;
      let x = Math.random() * width;
      let y = Math.random() * height;
      if (offscreen) {
        const edge = Math.random();
        if (edge < 0.5) {
          x = Math.random() * (width + margin);
          y = height + Math.random() * margin;
        } else {
          x = width + Math.random() * margin;
          y = Math.random() * (height + margin);
        }
      }
      return {
        x,
        y,
        radius,
        dx: -0.03,
        dy: -0.02,
        color: starColors[Math.floor(Math.random() * starColors.length)],
        glow: Math.random() * 40 + 60,
        baseAlpha: Math.random() * 0.4 + 0.6,
        twinkleSpeed: Math.random() * 0.02 + 0.005,
        twinkleOffset: Math.random() * Math.PI * 2,
      };
    }

    let stars = Array.from({
      length: 50
    }, () => createStar());

    function updateStars() {
      stars = stars.map((s) => {
        s.x += s.dx;
        s.y += s.dy;
        const twinkle = Math.sin(performance.now() * s.twinkleSpeed + s.twinkleOffset);
        s.alpha = s.baseAlpha + twinkle * 0.2;
        if (s.x < -60 || s.y < -60) return createStar(true);
        return s;
      });
    }

    function drawStars() {
      stars.forEach((s) => {
        ctx.beginPath();
        ctx.arc(s.x, s.y, s.radius, 0, Math.PI * 2);
        ctx.fillStyle = s.color.replace(/[\d\.]+\)$/g, `${Math.max(0, s.alpha)})`);
        ctx.shadowBlur = s.glow;
        ctx.shadowColor = s.color;
        ctx.fill();
      });
    }

    const nebulae = Array.from({
      length: 10
    }, () => ({
      x: Math.random() * width,
      y: Math.random() * height,
      radius: Math.random() * 220 + 150,
      color: `rgba(${130 + Math.floor(Math.random() * 100)}, ${20 + Math.floor(Math.random() * 30)}, ${180 + Math.floor(Math.random() * 75)}, 0.08)`,
    }));

    function drawNebulae() {
      const gradient = ctx.createLinearGradient(0, 0, width, height);
      gradient.addColorStop(0, "rgba(5, 10, 20, 1)");
      gradient.addColorStop(1, "rgba(10, 5, 30, 1)");
      ctx.fillStyle = gradient;
      ctx.fillRect(0, 0, width, height);

      nebulae.forEach((n) => {
        const grad = ctx.createRadialGradient(n.x, n.y, 0, n.x, n.y, n.radius);
        grad.addColorStop(0, n.color);
        grad.addColorStop(1, "transparent");
        ctx.fillStyle = grad;
        ctx.beginPath();
        ctx.arc(n.x, n.y, n.radius, 0, Math.PI * 2);
        ctx.fill();
      });
    }

    function draw() {
      ctx.fillStyle = "rgba(0, 0, 0, 0.2)";
      ctx.fillRect(0, 0, width, height);
      drawNebulae();
      updateParticles();
      drawParticles();
      updateStars();
      drawStars();
      requestAnimationFrame(draw);
    }

    draw();
  </script>
</body>

</html>