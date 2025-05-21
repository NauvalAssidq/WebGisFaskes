/**
 * @param {HTMLElement} tableElement
 * @param {HTMLElement} paginationContainer
 * @param {number} rowsPerPage
 * @param {HTMLElement} searchInput
 * @param {Array<number>} searchableColumns
 */
function createTablePagination(
  tableElement, 
  paginationContainer, 
  rowsPerPage = 5,
  searchInput = null,
  searchableColumns = []
) {
  const allRows = Array.from(tableElement.querySelectorAll('tbody tr'));
  let filteredRows = [...allRows];
  let currentPage = 1;
  let totalPages = Math.ceil(filteredRows.length / rowsPerPage);
  
  const filterRows = (searchTerm = '') => {
    if (!searchTerm) {
      filteredRows = [...allRows];
    } else {
      const term = searchTerm.toLowerCase();
      
      filteredRows = allRows.filter(row => {
        const columns = searchableColumns.length > 0 
          ? searchableColumns.map(i => row.cells[i])
          : Array.from(row.cells);
        
        return columns.some(cell => {
          return cell.textContent.toLowerCase().includes(term);
        });
      });
    }
    
    currentPage = 1;
    totalPages = Math.ceil(filteredRows.length / rowsPerPage);
    
    updateTable();
    createPagination();
  };
  
  if (searchInput) {
    searchInput.addEventListener('input', (e) => {
      filterRows(e.target.value);
    });
    
    const searchParent = searchInput.parentElement;
    const clearButton = searchParent.querySelector('.search-clear-btn');
    
    if (clearButton) {
      clearButton.addEventListener('click', () => {
        searchInput.value = '';
        filterRows('');
      });
    }
  }

  const updateTable = () => {
    allRows.forEach(row => {
      row.style.display = 'none';
    });
    
    filteredRows.forEach((row, index) => {
      const start = (currentPage - 1) * rowsPerPage;
      const end = start + rowsPerPage;
      row.style.display = (index >= start && index < end) ? '' : 'none';
    });
    
    const resultsInfo = document.querySelector('.pagination-results-info');
    if (resultsInfo) {
      const start = filteredRows.length > 0 ? (currentPage - 1) * rowsPerPage + 1 : 0;
      const end = Math.min(currentPage * rowsPerPage, filteredRows.length);
      resultsInfo.textContent = `Showing ${start} to ${end} of ${filteredRows.length} results`;
    }
  };

  if (filteredRows.length === 0) {
    paginationContainer.innerHTML = '<p class="text-center text-gray-500 py-4">No results found</p>';
    return;
  }

  const createPagination = () => {
    paginationContainer.innerHTML = '';
    
    if (filteredRows.length === 0) {
      paginationContainer.innerHTML = '<p class="text-center text-gray-500 py-4">No results found</p>';
      return;
    }
    
    if (totalPages <= 1) {
      const resultsInfoOnly = document.createElement('div');
      resultsInfoOnly.className = 'pagination-results-info text-sm text-slate-500';
      resultsInfoOnly.textContent = `Showing all ${filteredRows.length} results`;
      paginationContainer.appendChild(resultsInfoOnly);
      return;
    }

    const paginationWrapper = document.createElement('div');
    paginationWrapper.className = 'flex items-center justify-between gap-2';
    
    const resultsInfo = document.createElement('div');
    resultsInfo.className = 'pagination-results-info text-sm text-slate-500';
    const start = (currentPage - 1) * rowsPerPage + 1;
    const end = Math.min(currentPage * rowsPerPage, filteredRows.length);
    resultsInfo.textContent = `Showing ${start} to ${end} of ${filteredRows.length} results`;

    const controlsWrapper = document.createElement('div');
    controlsWrapper.className = 'flex items-center gap-2';

    const createButton = (text, disabled, clickHandler, extraClasses = '') => {
      const btn = document.createElement('button');
      btn.textContent = text;
      btn.disabled = disabled;
      btn.className = `px-3 py-1.5 rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-50 ${disabled ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer'} ${extraClasses}`;
      if (!disabled) {
        btn.addEventListener('click', clickHandler);
      }
      return btn;
    };

    const farPrevBtn = createButton('<<', currentPage === 1, () => {
      currentPage = 1;
      updateTable();
      createPagination();
    });

    const prevBtn = createButton('<', currentPage === 1, () => {
      if (currentPage > 1) {
        currentPage--;
        updateTable();
        createPagination();
      }
    });

    const nextBtn = createButton('>', currentPage === totalPages, () => {
      if (currentPage < totalPages) {
        currentPage++;
        updateTable();
        createPagination();
      }
    });

    const farNextBtn = createButton('>>', currentPage === totalPages, () => {
      currentPage = totalPages;
      updateTable();
      createPagination();
    });

    const pageGroup = document.createElement('div');
    pageGroup.className = 'flex gap-1';

    let startPage = Math.max(1, currentPage - 1);
    let endPage = Math.min(totalPages, startPage + 2);

    if (endPage - startPage < 2) {
      startPage = Math.max(1, endPage - 2);
    }

    for (let i = startPage; i <= endPage; i++) {
      const pageBtn = document.createElement('button');
      pageBtn.textContent = i;
      pageBtn.className = `page-btn w-8 h-8 rounded-lg text-sm ${
        i === currentPage ? 'bg-blue-600 text-white' : 'text-slate-600 hover:bg-slate-100'
      }`;
      pageBtn.addEventListener('click', () => {
        currentPage = i;
        updateTable();
        createPagination();
      });
      pageGroup.appendChild(pageBtn);
    }

    controlsWrapper.appendChild(farPrevBtn);
    controlsWrapper.appendChild(prevBtn);
    controlsWrapper.appendChild(pageGroup);
    controlsWrapper.appendChild(nextBtn);
    controlsWrapper.appendChild(farNextBtn);
    
    paginationWrapper.appendChild(resultsInfo);
    paginationWrapper.appendChild(controlsWrapper);

    paginationContainer.appendChild(paginationWrapper);
  };

  updateTable();
  createPagination();
  
  return {
    refresh: () => {
      filterRows(searchInput ? searchInput.value : '');
    },
    filter: (term) => {
      if (searchInput) searchInput.value = term;
      filterRows(term);
    },
    reset: () => {
      if (searchInput) searchInput.value = '';
      filterRows('');
    }
  };
}

/**
 * @param {string} containerId
 * @param {string} placeholder
 * @return {HTMLElement}
 */
function createTableSearch(containerId, placeholder = 'Search...') {
  const container = document.getElementById(containerId);
  if (!container) return null;
  
  const searchWrapper = document.createElement('div');
  searchWrapper.className = 'relative mb-4';
  
  const searchInput = document.createElement('input');
  searchInput.type = 'text';
  searchInput.className = 'table-search-input w-full px-4 py-2 pl-10 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent';
  searchInput.placeholder = placeholder;
  
  const searchIcon = document.createElement('div');
  searchIcon.className = 'absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400';
  searchIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>';
  
  const clearBtn = document.createElement('button');
  clearBtn.className = 'search-clear-btn absolute right-3 top-1/2 transform -translate-y-1/2 text-slate-400 hover:text-slate-600 hidden';
  clearBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>';
  
  searchInput.addEventListener('input', () => {
    clearBtn.classList.toggle('hidden', !searchInput.value);
  });
  
  searchWrapper.appendChild(searchIcon);
  searchWrapper.appendChild(searchInput);
  searchWrapper.appendChild(clearBtn);
  
  container.appendChild(searchWrapper);
  
  searchInput.addEventListener('input', () => {
    clearBtn.style.display = searchInput.value ? 'block' : 'none';
  });

  clearBtn.addEventListener('click', () => {
    searchInput.value = '';
    clearBtn.style.display = 'none';
    const event = new Event('input', { bubbles: true });
    searchInput.dispatchEvent(event);
  });

  searchWrapper.appendChild(searchInput);
  searchWrapper.appendChild(searchIcon);
  searchWrapper.appendChild(clearBtn);
  container.appendChild(searchWrapper);

  return searchInput;
}

// Cara pakai:
// document.addEventListener('DOMContentLoaded', () => {
//   // Create search input
//   const searchInput = createTableSearch('search-container', 'Search facilities...');
//   
//   // Initialize pagination with search
//   const table = document.querySelector('#myTable');
//   const paginationContainer = document.querySelector('#pagination');
//   createTablePagination(table, paginationContainer, 10, searchInput, [0, 1, 2]); // Search columns 0, 1, and 2
// });