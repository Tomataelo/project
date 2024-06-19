
document.addEventListener("DOMContentLoaded", function () {
    const inputs = document.querySelectorAll('.data-table tbody input[type="text"], .data-table tbody input[type="checkbox"]');
    const inputStates = [];
  
    let currentPageNum = 1;
    const itemsPerPage = 10;
  
    function initializeStates() {
      inputStates.length = 0;
      const totalPages = Math.ceil(inputs.length / itemsPerPage);
      for (let i = 0; i < totalPages; i++) {
        inputStates.push([]);
      }
    }
  
    function updatePagination() {
      inputs.forEach(input => {
        input.closest("tr").style.display = "";
      });
  
      const startIndex = (currentPageNum - 1) * itemsPerPage;
      const endIndex = Math.min(startIndex + itemsPerPage, inputs.length);
  
      inputs.forEach((input, index) => {
        const inputIndex = index - startIndex;
        if (index >= startIndex && index < endIndex) {
          if (input.type === "checkbox") {
            input.checked = inputStates[currentPageNum - 1][inputIndex] || false;
          } else if (input.type === "text") {
            input.value = inputStates[currentPageNum - 1][inputIndex] || "";
          }
        } else {
          input.closest("tr").style.display = "none";
        }
      });
    }
  
    initializeStates();
    updatePagination();
  
    inputs.forEach((input, index) => {
      input.addEventListener("change", function () {
        const startIndex = (currentPageNum - 1) * itemsPerPage;
        const inputIndex = index % itemsPerPage;
        if (input.type === "checkbox") {
          inputStates[currentPageNum - 1][inputIndex] = input.checked;
        } else if (input.type === "text") {
          inputStates[currentPageNum - 1][inputIndex] = input.value;
        }
      });
    });
  
    const prevPageBtn = document.getElementById("prevPageBtn");
    const nextPageBtn = document.getElementById("nextPageBtn");
    const currentPage = document.getElementById("currentPage");
    const totalPages = document.getElementById("totalPages");
  
    function updatePaginationButtons() {
      const totalPagesCount = Math.ceil(inputs.length / itemsPerPage);
  
      totalPages.textContent = totalPagesCount;
  
      prevPageBtn.disabled = currentPageNum === 1;
      nextPageBtn.disabled = currentPageNum === totalPagesCount;
  
      currentPage.textContent = currentPageNum;
    }
  
    prevPageBtn.addEventListener("click", function () {
      if (currentPageNum > 1) {
        currentPageNum--;
        updatePagination();
        updatePaginationButtons();
      }
    });
  
    nextPageBtn.addEventListener("click", function () {
      const totalPagesCount = Math.ceil(inputs.length / itemsPerPage);
  
      if (currentPageNum < totalPagesCount) {
        currentPageNum++;
        updatePagination();
        updatePaginationButtons();
      }
    });
  });
  