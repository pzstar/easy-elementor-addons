;(function ($, elementor) {
	$(window).on('elementor/frontend/init', function () {
	    var ModuleHandler = elementorModules.frontend.handlers.Base,
	        Tooltip;
		const configTltpStyles = {
			cora: {
				in: {
					base: {
						duration: 600,
						easing: 'easeOutQuint',
						scale: [0,1],
						rotate: [-180,0],
						opacity: {
							value: 1,
							easing: 'linear',
							duration: 100
						}
					},
					content: {
						duration: 300,
						delay: 250,
						easing: 'easeOutQuint',
						translateY: [20,0],
						opacity: {
							value: 1,
							easing: 'linear',
							duration: 100
						}
					},
					trigger: {
						duration: 300,
						easing: 'easeOutExpo',
						scale: [1,0.9],
						color: '#6fbb95'
					}
				},
				out: {
					base: {
						duration: 150,
						delay: 50,
						easing: 'easeInQuad',
						scale: 0,
						opacity: {
							delay: 100,
							value: 0,
							easing: 'linear'
						}
					},
					content: {
						duration: 100,
						easing: 'easeInQuad',
						translateY: 20,
						opacity: {
							value: 0,
							easing: 'linear'
						}
					},
					trigger: {
						duration: 300,
						delay: 50,
						easing: 'easeOutExpo',
						scale: 1,
						color: '#666'
					}
				}
			},
			smaug: {
				in: {
					base: {
						duration: 200,
						easing: 'easeOutQuad',
						rotate: [35,0],
						opacity: {
							value: 1,
							easing: 'linear',
							duration: 100
						}
					},
					content: {
						duration: 1000,
						delay: 50,
						easing: 'easeOutElastic',
						translateX: [50,0],
						rotate: [10, 0],
						opacity: {
							value: 1,
							easing: 'linear',
							duration: 100
						}
					},
					trigger: {
						translateX: [
							{value: '-30%', duration: 130, easing: 'easeInQuad'},
							{value: ['30%','0%'], duration: 900, easing: 'easeOutElastic'}
						],
						opacity: [
							{value: 0, duration: 130, easing: 'easeInQuad'},
							{value: 1, duration: 130, easing: 'easeOutQuad'}
						],
						color: [
							{value: '#6fbb95', duration: 1, delay: 130, easing: 'easeOutQuad'}
						]
					}
				},
				out: {
					base: {
						duration: 200,
						delay: 100,
						easing: 'easeInQuad',
						rotate: -35,
						opacity: 0
					},
					content: {
						duration: 200,
						easing: 'easeInQuad',
						translateX: -30,
						rotate: -10,
						opacity: 0
					},
					trigger: {
						translateX: [
							{value: '-30%', duration: 200, easing: 'easeInQuad'},
							{value: ['30%','0%'], duration: 200, easing: 'easeOutQuad'}
						],
						opacity: [
							{value: 0, duration: 200, easing: 'easeInQuad'},
							{value: 1, duration: 200, easing: 'easeOutQuad'}
						],
						color: [
							{value: '#666', duration: 1, delay: 200, easing: 'easeOutQuad'}
						]
					}
				}
			},
			uldor: {
				in: {
					base: {
						duration: 400,
						easing: 'easeOutExpo',
						scale: [0.5,1],
						opacity: {
							value: 1,
							easing: 'linear',
							duration: 100
						}
					},
					path: {
						duration: 900,
						easing: 'easeOutElastic',
						d: 'M 33.5,31 C 33.5,31 145,31 200,31 256,31 367,31 367,31 367,31 367,110 367,150 367,190 367,269 367,269 367,269 256,269 200,269 145,269 33.5,269 33.5,269 33.5,269 33.5,190 33.5,150 33.5,110 33.5,31 33.5,31 Z'
					},
					content: {
						duration: 900,
						easing: 'easeOutElastic',
						delay: 100,
						scale: [0.8,1],
						opacity: {
							value: 1,
							easing: 'linear',
							duration: 100
						}
					},
					trigger: {
						translateY: [
							{value: '-50%', duration: 100, easing: 'easeInQuad'},
							{value: ['50%','0%'], duration: 100, easing: 'easeOutQuad'}
						],
						opacity: [
							{value: 0, duration: 100, easing: 'easeInQuad'},
							{value: 1, duration: 100, easing: 'easeOutQuad'}
						],
						color: {
							value: '#6fbb95', 
							duration: 1, 
							delay: 100, 
							easing: 'easeOutQuad'
						}
					}
				},
				out: {
					base: {
						duration: 200,
						easing: 'easeInExpo',
						scale: 0.5,
						opacity: {
							value: 0,
							duration: 75,
							easing: 'linear'
						}
					},
					path: {
						duration: 200,
						easing: 'easeOutQuint',
						d: 'M 79.5,66 C 79.5,66 128,106 202,105 276,104 321,66 321,66 321,66 287,84 288,155 289,226 318,232 318,232 318,232 258,198 200,198 142,198 80.5,230 80.5,230 80.5,230 112,222 111,152 110,82 79.5,66 79.5,66 Z'
					},
					content: {
						duration: 100,
						easing: 'easeOutQuint',
						scale: 0.8,
						opacity: {
							value: 0,
							duration: 50,
							easing: 'linear'
						}
					},
					trigger: {
						translateY: [
							{value: '50%', duration: 100, easing: 'easeInQuad'},
							{value: ['-50%','0%'], duration: 100, easing: 'easeOutQuad'}
						],
						opacity: [
							{value: 0, duration: 100, easing: 'easeInQuad'},
							{value: 1, duration: 100, easing: 'easeOutQuad'}
						],
						color: {
							value: '#666', 
							duration: 1, 
							delay: 100, 
							easing: 'easeOutQuad'
						}
					}
				}
			},
			dori: {
				in: {
					base: {
						duration: 800,
						easing: 'easeOutElastic',
						translateY: [60,0],
						scale: [0.5,1],
						opacity: {
							value: 1,
							easing: 'linear',
							duration: 100
						}
					},
					path: {
						duration: 1200,
						delay: 50,
						easing: 'easeOutElastic',
						elasticity: 700,
						d: 'M 22,74.2 22,202 C 22,202 82,202 103,202 124,202 184,202 184,202 L 200,219 216,202 C 216,202 274,202 297,202 320,202 378,202 378,202 L 378,74.2 C 378,74.2 318,73.7 200,73.7 82,73.7 22,74.2 22,74.2 Z'
					},
					content: {
						duration: 300,
						delay: 100,
						easing: 'easeOutQuint',
						translateY: [20,0],
						opacity: {
							value: 1,
							easing: 'linear',
							duration: 100
						}
					},
					trigger: {
						translateY: [
							{value: '-50%', duration: 100, easing: 'easeInQuad'},
							{value: ['50%','0%'], duration: 100, easing: 'easeOutQuad'}
						],
						opacity: [
							{value: 0, duration: 100, easing: 'easeInQuad'},
							{value: 1, duration: 100, easing: 'easeOutQuad'}
						],
						color: {
							value: '#6fbb95', 
							duration: 1, 
							delay: 100, 
							easing: 'easeOutQuad'
						}
					}
				},
				out: {
					base: {
						duration: 200,
						easing: 'easeInQuad',
						translateY: 60,
						scale: 0.5,
						opacity: {
							value: 0,
							delay: 100,
							duration: 100,
							easing: 'linear'
						}
					},
					path: {
						duration: 200,
						easing: 'easeInQuad',
						d: 'M 22,108 22,236 C 22,236 64,216 103,212 142,208 184,212 184,212 L 200,229 216,212 C 216,212 258,207 297,212 336,217 378,236 378,236 L 378,108 C 378,108 318,83.7 200,83.7 82,83.7 22,108 22,108 Z'
					},
					content: {
						duration: 100,
						easing: 'easeInQuad',
						translateY: 20,
						opacity: {
							value: 0,
							easing: 'linear'
						}
					},
					trigger: {
						translateY: [
							{value: '-50%', duration: 100, easing: 'easeInQuad'},
							{value: ['50%','0%'], duration: 100, easing: 'easeOutQuad'}
						],
						opacity: [
							{value: 0, duration: 100, easing: 'easeInQuad'},
							{value: 1, duration: 100, easing: 'easeOutQuad'}
						],
						color: {
							value: '#666', 
							duration: 1, 
							delay: 100, 
							easing: 'easeOutQuad'
						}
					}
				}
			},
			walda: {
				in: {
					base: {
						duration: 100,
						easing: 'linear',
						opacity: 1
					},
					deco: {
						duration: 500,
						easing: 'easeOutExpo',
						scaleY: [0,1]
					},
					content: {
						duration: 125,
						easing: 'easeOutExpo',
						delay: function(t,i) {
							return i*15;
						},
						easing: 'linear',
						translateY: ['50%','0%'],
						opacity: [0,1]
					},
					trigger: {
						translateX: [
							{value: '30%', duration: 100, easing: 'easeInQuad'},
							{value: ['-30%','0%'], duration: 100, easing: 'easeOutQuad'}
						],
						opacity: [
							{value: 0, duration: 100, easing: 'easeInQuad'},
							{value: 1, duration: 100, easing: 'easeOutQuad'}
						],
						color: [
							{value: '#6fbb95', duration: 1, delay: 100, easing: 'easeOutQuad'}
						]
					}
				},
				out: {
					base: {
						duration: 100,
						delay: 100,
						easing: 'linear',
						opacity: 0
					},
					deco: {
						duration: 400,
						easing: 'easeOutExpo',
						scaleY: 0
					},
					content: {
						duration: 1,
						easing: 'linear',
						opacity: 0
					},
					trigger: {
						translateX: [
							{value: '30%', duration: 100, easing: 'easeInQuad'},
							{value: ['-30%','0%'], duration: 100, easing: 'easeOutQuad'}
						],
						opacity: [
							{value: 0, duration: 100, easing: 'easeInQuad'},
							{value: 1, duration: 100, easing: 'easeOutQuad'}
						],
						color: [
							{value: '#666', duration: 1, delay: 100, easing: 'easeOutQuad'}
						]
					}
				},	
			},
			gram: {
				in: {
					base: {
						duration: 400,
						easing: 'easeOutQuint',
						scaleX: [1.2,1],
						opacity: {
							value: 1,
							easing: 'linear',
							duration: 50
						}
					},
					path: {
						duration: 600,
						easing: 'easeOutQuint',
						d: 'M 92.4,79 C 136,79 156,79.1 200,79.4 244,79.7 262,79 308,79 354,79 381,111 381,150 381,189 346,220 308,221 270,222 236,221 200,221 164,221 130,222 92.4,221 54.4,220 19,189 19,150 19,111 48.6,79 92.4,79 Z'
					},
					content: {
						delay: 100,
						scale: {
							value: [0.8,1],
							duration: 300,
							easing: 'easeOutQuint'
						},
						opacity: {
							value: [0,1],
							easing: 'linear',
							duration: 100
						}
					},
					trigger: {
						duration: 300,
						easing: 'easeOutQuint',
						scale: [1,0.9],
						color: '#6fbb95'
					}
				},
				out: {
					base: {
						duration: 200,
						easing: 'easeInQuint',
						scaleX: 1.1,
						scaleY: 0.9,
						opacity: {
							value: 0,
							delay: 100,
							duration: 150,
							easing: 'linear'
						}
					},
					path: {
						duration: 200,
						easing: 'easeInQuint',
						d: 'M 92.4,79 C 136,79 154,115 200,116 246,117 263,80.4 308,79 353,77.6 381,111 381,150 381,189 346,220 308,221 270,222 236,188 200,188 164,188 130,222 92.4,221 54.4,220 19,189 19,150 19,111 48.6,79 92.4,79 Z'
					},
					content: {
						duration: 150,
						easing: 'easeInQuint',
						scale: 0.8,
						opacity: {
							value: 0,
							duration: 100,
							easing: 'linear'
						}
					},
					trigger: {
						duration: 200,
						easing: 'easeInQuint',
						scale: 1,
						color: '#666'
					}
				}
			},
			narvi: {
				in: {
					base: {
						duration: 1,
						easing: 'linear',
						opacity: 1
					},
					path: {
						duration: 800,
						easing: 'easeOutQuint',
						rotate: [0,90],
						opacity: {
							value: 1,
							duration: 200,
							easing: 'linear'
						}
					},
					content: {
						duration: 600,
						easing: 'easeOutQuint',
						translateX: [50,0],
						opacity: {
							value: 1,
							duration: 100,
							easing: 'linear'
						}
					},
					trigger: {
						translateX: [
							{value: '-30%', duration: 100, easing: 'easeInQuint'},
							{value: ['30%','0%'], duration: 250, easing: 'easeOutQuint'}
						],
						opacity: [
							{value: 0, duration: 100, easing: 'easeInQuint'},
							{value: 1, duration: 250, easing: 'easeOutQuint'}
						],
						color: [
							{value: '#6fbb95', duration: 1, delay: 100, easing: 'easeOutQuint'}
						]
					}
				},
				out: {
					base: {
						duration: 100,
						delay: 400,
						easing: 'linear',
						opacity: 0
					},
					path: {
						duration: 500,
						delay: 0,
						easing: 'easeInOutQuint',
						rotate: 0,
						opacity: {
							value: 0,
							duration: 50,
							delay: 210,
							easing: 'linear'
						}
					},
					content: {
						duration: 500,
						easing: 'easeInOutQuint',
						translateX: 100,
						opacity: {
							value: 0,
							duration: 50,
							delay: 210,
							easing: 'linear'
						}
					},
					trigger: {
						translateX: [
							{value: '30%', duration: 200, easing: 'easeInQuint'},
							{value: ['-30%','0%'], duration: 200, easing: 'easeOutQuint'}
						],
						opacity: [
							{value: 0, duration: 200, easing: 'easeInQuint'},
							{value: 1, duration: 200, easing: 'easeOutQuint'}
						],
						color: [
							{value: '#666', duration: 1, delay: 200, easing: 'easeOutQuint'}
						]
					}
				}
			},
			indis: {
				in: {
					base: {
						duration: 500,
						easing: 'easeOutQuint',
						translateY: [100,0],
						opacity: {
							value: 1,
							duration: 50,
							easing: 'linear'
						}
					},
					shape: {
						duration: 350,
						easing: 'easeOutBack',
						scaleY:  {
							value: [1.3,1],
							duration: 1300,
							easing: 'easeOutElastic',
							elasticity: 500
						},
						scaleX: {
							value: [0.3,1],
							duration: 1300,
							easing: 'easeOutElastic',
							elasticity: 500
						},
					},
					path: {
						duration: 450,
						easing: 'easeInOutQuad',
						d: 'M 44.5,24 C 148,24 252,24 356,24 367,24 376,32.9 376,44 L 376,256 C 376,267 367,276 356,276 252,276 148,276 44.5,276 33.4,276 24.5,267 24.5,256 L 24.5,44 C 24.5,32.9 33.4,24 44.5,24 Z'
					},	
					content: {
						duration: 300,
						delay: 50,
						easing: 'easeOutQuad',
						translateY: [10,0],
						opacity: {
							value: 1,
							easing: 'linear',
							duration: 100
						}
					},
					trigger: {
						translateY: [
							{value: '-50%', duration: 100, easing: 'easeInQuad'},
							{value: ['50%','0%'], duration: 100, easing: 'easeOutQuad'}
						],
						opacity: [
							{value: 0, duration: 100, easing: 'easeInQuad'},
							{value: 1, duration: 100, easing: 'easeOutQuad'}
						],
						color: {
							value: '#6fbb95', 
							duration: 1, 
							delay: 100, 
							easing: 'easeOutQuad'
						}
					}
				},
				out: {
					base: {
						duration: 320,
						delay: 50,
						easing: 'easeInOutQuint',
						scaleY: 1.5,
						scaleX: 0,
						translateY: -100,
						opacity: {
							value: 0,
							duration: 100,
							delay: 130,
							easing: 'linear'
						}
					},
					path: {
						duration: 300,
						delay: 50,
						easing: 'easeInOutQuint',
						d: 'M 44.5,24 C 138,4.47 246,-6.47 356,24 367,26.9 376,32.9 376,44 L 376,256 C 376,267 367,279 356,276 231,240 168,241 44.5,276 33.8,279 24.5,267 24.5,256 L 24.5,44 C 24.5,32.9 33.6,26.3 44.5,24 Z'
					},
					content: {
						duration: 300,
						easing: 'easeInOutQuad',
						translateY: -40,
						opacity: {
							value: 0,
							duration: 100,
							delay: 135,
							easing: 'linear'
						}
					},
					trigger: {
						translateY: [
							{value: '-50%', duration: 100, easing: 'easeInQuad'},
							{value: ['50%','0%'], duration: 100, easing: 'easeOutQuad'}
						],
						opacity: [
							{value: 0, duration: 100, easing: 'easeInQuad'},
							{value: 1, duration: 100, easing: 'easeOutQuad'}
						],
						color: {
							value: '#666', 
							duration: 1, 
							delay: 100, 
							easing: 'easeOutQuad'
						}
					}
				}
			},
			amras: {
				in: {
					base: {
						duration: 1,
						delay: 50,
						easing: 'linear',
						opacity: 1
					},
					path: {
						duration: 800,
						delay: 100,
						easing: 'easeOutElastic',
						delay: function(t,i) {
							return i*20;
						},
						scale: [0,1],
					},	
					content: {
						duration: 300,
						delay: 250,
						easing: 'easeOutExpo',
						scale: [0.7,1],
						opacity: {
							value: 1,
							easing: 'linear',
							duration: 100
						}
					},
					trigger: {
						translateY: [
							{value: '50%', duration: 100, easing: 'easeInQuad'},
							{value: ['-50%','0%'], duration: 100, easing: 'easeOutQuad'}
						],
						opacity: [
							{value: 0, duration: 100, easing: 'easeInQuad'},
							{value: 1, duration: 100, easing: 'easeOutQuad'}
						],
						color: {
							value: '#6fbb95', 
							duration: 1, 
							delay: 100, 
							easing: 'easeOutQuad'
						}
					}
				},
				out: {
					base: {
						duration: 1,
						delay: 450,
						easing: 'linear',
						opacity: 0
					},
					path: {
						duration: 500,
						easing: 'easeOutExpo',
						delay: function(t,i,c) {
							return (c-i-1)*40;
						},
						scale: 0
					},
					content: {
						duration: 300,
						easing: 'easeOutExpo',
						scale: 0.7,
						opacity: {
							value: 0,
							duration: 100,
							easing: 'linear'
						}
					},
					trigger: {
						translateY: [
							{value: '-50%', duration: 100, easing: 'easeInQuad'},
							{value: ['50%','0%'], duration: 100, easing: 'easeOutQuad'}
						],
						opacity: [
							{value: 0, duration: 100, easing: 'easeInQuad'},
							{value: 1, duration: 100, easing: 'easeOutQuad'}
						],
						color: {
							value: '#666', 
							duration: 1, 
							delay: 100, 
							easing: 'easeOutQuad'
						}
					}
				}
			},
			hador: {
				in: {
					base: {
						duration: 1,
						delay: 100,
						easing: 'linear',
						opacity: 1
					},
					path: {
						duration: 1000,
						easing: 'easeOutExpo',
						delay: function(t,i) {
							return i*150;
						},
						scale: [0,1],
						translateY: function(t,i,c) {
							return i === c-1 ? ['50%','0%'] : 0;
						},
						rotate: function(t,i,c) {
							return i === c-1 ? [90,0] : 0;
						}
					},	
					content: {
						duration: 600,
						delay: 750,
						easing: 'easeOutExpo',
						scale: [0.5,1],
						opacity: {
							value: 1,
							easing: 'linear',
							duration: 400
						}
					},
					trigger: {
						translateX: [
							{value: '30%', duration: 200, easing: 'easeInExpo'},
							{value: ['-30%','0%'], duration: 200, easing: 'easeOutExpo'}
						],
						opacity: [
							{value: 0, duration: 200, easing: 'easeInExpo'},
							{value: 1, duration: 200, easing: 'easeOutExpo'}
						],
						color: [
							{value: '#6fbb95', duration: 1, delay: 200, easing: 'easeOutExpo'}
						]
					}
				},
				out: {
					base: {
						duration: 1,
						delay: 450,
						easing: 'linear',
						opacity: 0
					},
					path: {
						duration: 300,
						easing: 'easeOutExpo',
						delay: function(t,i,c) {
							return (c-i-1)*50;
						},
						scale: 0
					},	
					content: {
						duration: 200,
						easing: 'easeOutExpo',
						scale: 0.7,
						opacity: {
							value: 0,
							duration: 50,
							easing: 'linear'
						}
					},
					trigger: {
						translateX: [
							{value: '30%', duration: 100, easing: 'easeInQuad'},
							{value: ['-30%','0%'], duration: 100, easing: 'easeOutQuad'}
						],
						opacity: [
							{value: 0, duration: 100, easing: 'easeInQuad'},
							{value: 1, duration: 100, easing: 'easeOutQuad'}
						],
						color: [
							{value: '#666', duration: 1, delay: 100, easing: 'easeOutQuad'}
						]
					}
				}
			},
			malva: {
				in: {
					base: {
						translateX: [
							{value: 3, duration: 100, delay: 150, easing: 'linear'},
							{value: -3, duration: 100, easing: 'linear'},
							{value: 3, duration: 100, easing: 'linear'},
							{value: -3, duration: 100, easing: 'linear'},
							{value: 3, duration: 100, easing: 'linear'},
							{value: -3, duration: 100, easing: 'linear'},
							{value: 3, duration: 100, easing: 'linear'},
							{value: -3, duration: 100, easing: 'linear'},
							{value: 0, duration: 100, easing: [0.1,1,0.3,1]},
						],
						translateY: [
							{value: -3, duration: 100, delay: 150, easing: 'linear'},
							{value: 3, duration: 100, easing: 'linear'},
							{value: -3, duration: 100, easing: 'linear'},
							{value: 3, duration: 100, easing: 'linear'},
							{value: -3, duration: 100, easing: 'linear'},
							{value: 3, duration: 100, easing: 'linear'},
							{value: -3, duration: 100, easing: 'linear'},
							{value: 3, duration: 100, easing: 'linear'},
							{value: 0, duration: 100, easing: [0.1,1,0.3,1]},
						],
						scale: [
							{value: [0,1.1], duration: 150,easing: [0.1,1,0.3,1]},
							{value: 1.2, duration: 800,easing: 'linear'},
							{value: 1, duration: 150, easing: [0.1,1,0.3,1] },
						],
						opacity: {
							value: 1,
							easing: 'linear',
							duration: 1
						}
					},
					content: {
						duration: 100,
						easing: 'linear',
						opacity: 1
					},
					trigger: {
						duration: 300,
						easing: 'easeOutExpo',
						scale: [1,0.9],
						color: '#6fbb95'
					}
				},
				out: {
					base: {
						duration: 150,
						delay: 50,
						easing: 'easeInQuad',
						scale: 0,
						opacity: {
							delay: 100,
							value: 0,
							easing: 'linear'
						}
					},
					content: {
						duration: 100,
						easing: 'easeInQuad',
						opacity: {
							value: 0,
							easing: 'linear'
						}
					},
					trigger: {
						duration: 300,
						delay: 50,
						easing: 'easeOutExpo',
						scale: 1,
						color: '#666'
					}
				}
			},
			sadoc: {
				in: {
					base: {
						duration: 1,
						delay: 100,
						easing: 'linear',
						opacity: 1,
						translateY: {
							value: [-40,0],
							duration: 800,
							easing: 'easeOutElastic'
						}
					},
					path: {
						duration: 600,
						easing: 'easeInOutSine',
						strokeDashoffset: [anime.setDashoffset, 0],
						fill: {
							value: '#141514',
							duration: 400,
							delay: 500,
							easing: 'linear'
						}
					},
					content: {
						duration: 800,
						delay: 420,
						easing: 'easeOutElastic',
						translateY: [20,0],
						opacity: {
							value: 1,
							easing: 'linear',
							duration: 100
						}
					},
					trigger: {
						translateY: [
							{value: '50%', duration: 100, easing: 'easeInQuad'},
							{value: ['-50%','0%'], duration: 100, easing: 'easeOutQuad'}
						],
						opacity: [
							{value: 0, duration: 100, easing: 'easeInQuad'},
							{value: 1, duration: 100, easing: 'easeOutQuad'}
						],
						color: {
							value: '#6fbb95', 
							duration: 1,
							delay: 100, 
							easing: 'easeOutQuad'
						}
					}
				},
				out: {
					base: {
						duration: 1,
						delay: 400,
						easing: 'linear',
						opacity: 0
					},
					path: {
						duration: 300,
						easing: 'easeInOutSine',
						strokeDashoffset: anime.setDashoffset,
						fill: {
							value: '#2a2c2b',
							duration: 400,
							easing: 'linear'
						}
					},
					content: {
						duration: 200,
						easing: 'easeOutExpo',
						translateY: 20,
						opacity: {
							value: 0,
							easing: 'linear',
							duration: 50
						}
					},
					trigger: {
						translateY: [
							{value: '50%', duration: 100, easing: 'easeInQuad'},
							{value: ['-50%','0%'], duration: 100, easing: 'easeOutQuad'}
						],
						opacity: [
							{value: 0, duration: 100, easing: 'easeInQuad'},
							{value: 1, duration: 100, easing: 'easeOutQuad'}
						],
						color: {
							value: '#666', 
							duration: 1, 
							delay: 100, 
							easing: 'easeOutQuad'
						}
					}
				}
			}
		};
		const svgStyles = [
			'<svg class="tooltip__shape" width="100%" height="100%" viewBox="0 0 400 300"><path d="M 199,21.9 C 152,22.2 109,35.7 78.8,57.4 48,79.1 29,109 29,142 29,172 45.9,201 73.6,222 101,243 140,258 183,260 189,270 200,282 200,282 200,282 211,270 217,260 261,258 299,243 327,222 354,201 371,172 371,142 371,109 352,78.7 321,57 290,35.3 247,21.9 199,21.9 Z"/></svg>',
			'<svg class="tooltip__shape" width="100%" height="100%" viewBox="0 0 400 300"><path d="M 314,100 C 313,100 312,100 311,100 L 89.5,100 C 55.9,100 29.1,121 29.1,150 29.1,178 53.1,201 89.5,201 L 184,201 200,223 217,201 311,201 C 344,201 371,178 371,150 371,122 346,99 314,100 Z"/></svg>',
			'<svg class="tooltip__shape" width="100%" height="100%" viewBox="0 0 400 300"><path d="M 79.5,66 C 79.5,66 128,106 202,105 276,104 321,66 321,66 321,66 287,84 288,155 289,226 318,232 318,232 318,232 258,198 200,198 142,198 80.5,230 80.5,230 80.5,230 112,222 111,152 110,82 79.5,66 79.5,66 Z"/></svg>',
			'<svg class="tooltip__shape" width="100%" height="100%" viewBox="0 0 400 300"><path d="M 22,108 22,236 C 22,236 64,216 103,212 142,208 184,212 184,212 L 200,229 216,212 C 216,212 258,207 297,212 336,217 378,236 378,236 L 378,108 C 378,108 318,83.7 200,83.7 82,83.7 22,108 22,108 Z"/></svg>',
			'<svg class="tooltip__shape" width="100%" height="100%" viewBox="0 0 400 300"><path d="M 92.4,79 C 136,79 154,115 200,116 246,117 263,80.4 308,79 353,77.6 381,111 381,150 381,189 346,220 308,221 270,222 236,188 200,188 164,188 130,222 92.4,221 54.4,220 19,189 19,150 19,111 48.6,79 92.4,79 Z"/></svg>',
			'<svg class="tooltip__shape" width="100%" height="100%" viewBox="0 0 400 300"><path d="M 44.5,24 C 138,4.47 246,-6.47 356,24 367,26.9 376,32.9 376,44 L 376,256 C 376,267 367,279 356,276 231,240 168,241 44.5,276 33.8,279 24.5,267 24.5,256 L 24.5,44 C 24.5,32.9 33.6,26.3 44.5,24 Z"/></svg>',
			'<svg class="tooltip__shape" width="100%" height="100%" viewBox="0 0 400 300"><path class="path-narvi" d="M 307,150 199,212 92.5,274 92.7,150 92.5,26.2 200,88.4 Z"/></svg>'
			];
	    Tooltip = ModuleHandler.extend({

	        bindEvents: function () {
	            this.run();
	        },

	        getDefaultSettings: function () {
	            return {
	                allowHTML: true,
	            };
	        },

	        onElementChange: function (prop) {
	            if (prop.indexOf('eead_tltp_') !== -1) {
	                this.instance.destroy();
	                this.run();
	            }
	        },

	        settings: function (key) {
	            return this.getElementSettings('eead_tltp_' + key);
	        },

	        run: function () {
	            if (this.settings('active') != 'yes') {
                    return;
                }

                var options = this.getDefaultSettings(),
                    $element = this.$element,
                    $widgetId = '.elementor-element-' + this.getID(),
                    $elementID = this.getID(),
                    $globalthis = this;

                var $list = this.settings('list');

                $list.forEach(element => {
                	var $selectElement = '',
                		isShown = false,
                        bracketOn = '',
                        tooltipDOM = {},
                        tooltiptype = element.eead_tltp_type;

                    if (element.eead_tltp_select_type == 'widget') {
                        $selectElement = $widgetId;
                    }
                    if (element.eead_tltp_select_type == 'custom') {
                        var customSelector = element.eead_tltp_custom_selector;

                        if (element.eead_tltp_custom_selector && customSelector.length > 1) {
                            $selectElement = customSelector;
                        }
                    }

                    var tooltipBaseHTML = '<div class="tooltip__base">\
						' + (tooltiptype == 'walda' ? '<div class="tooltip__deco"></div>' : '') + ' \
						'+ svgStyles[0] +' \
						<div class="tooltip__content" id="info-'+ tooltiptype +'"> \
						' + (tooltiptype == 'walda' ? '<span class="tooltip__letters">' : '') + ' \
						'+ element.eead_tltp_tooltip_text +'</span>\
						' + (tooltiptype == 'walda' ? '</div>' : '') + ' \
					</div><!-- /tooltip__base -->';
					$($selectElement).append(tooltipBaseHTML);

					tooltipDOM.el = $($selectElement)[0];console.log(tooltipDOM.el);
					tooltipDOM.trigger = $($selectElement)[0];
					// tooltipDOM.triggerSpan = $($selectElement)[0];
					tooltipDOM.base = tooltipDOM.el.querySelector('.tooltip__base');
					tooltipDOM.shape = tooltipDOM.base.querySelector('.tooltip__shape');
					if( tooltipDOM.shape ) {
						tooltipDOM.path = tooltipDOM.shape.childElementCount > 1 ? Array.from(tooltipDOM.shape.querySelectorAll('path')) : tooltipDOM.shape.querySelector('path');
					}
					tooltipDOM.deco = tooltipDOM.base.querySelector('.tooltip__deco');
					tooltipDOM.content = tooltipDOM.base.querySelector('.tooltip__content');

					tooltipDOM.letters = tooltipDOM.content.querySelector('.tooltip__letters');
					if( tooltipDOM.letters ) {
						// Create spans for each letter.
						charming(tooltipDOM.letters);
						// Redefine content.
						tooltipDOM.content = tooltipDOM.letters.querySelectorAll('span');
					}
					tooltipDOM.trigger.addEventListener('mouseenter', mouseenterFn);
					tooltipDOM.trigger.addEventListener('mouseleave', mouseleaveFn);
					tooltipDOM.trigger.addEventListener('touchstart', mouseenterFn);
					tooltipDOM.trigger.addEventListener('touchend', mouseleaveFn);

					function mouseenterFn() {
						mouseTimeout = setTimeout(() => {
							isShown = true;
							animate('in');
						}, 75);
					}
					function mouseleaveFn() {
						clearTimeout(mouseTimeout);
						if( isShown ) {
							isShown = false;
							animate('out');
						}
					}
					function animate(dir) {
						if ( configTltpStyles[tooltiptype][dir].base ) {
							anime.remove(tooltipDOM.base);
							let baseAnimOpts = {targets: tooltipDOM.base};
							anime(Object.assign(baseAnimOpts, configTltpStyles[tooltiptype][dir].base));
						}
						if ( configTltpStyles[tooltiptype][dir].shape ) {
							anime.remove(tooltipDOM.shape);
							let shapeAnimOpts = {targets: tooltipDOM.shape};
							anime(Object.assign(shapeAnimOpts, configTltpStyles[tooltiptype][dir].shape));
						}
						if ( configTltpStyles[tooltiptype][dir].path ) {
							anime.remove(tooltipDOM.path);
							let shapeAnimOpts = {targets: tooltipDOM.path};
							anime(Object.assign(shapeAnimOpts, configTltpStyles[tooltiptype][dir].path));
						}
						if ( configTltpStyles[tooltiptype][dir].content ) {
							anime.remove(tooltipDOM.content);
							let contentAnimOpts = {targets: tooltipDOM.content};
							anime(Object.assign(contentAnimOpts, configTltpStyles[tooltiptype][dir].content));
						}
						if ( configTltpStyles[tooltiptype][dir].trigger ) {
							anime.remove(tooltipDOM.triggerSpan);
							let triggerAnimOpts = {targets: tooltipDOM.triggerSpan};
							anime(Object.assign(triggerAnimOpts, configTltpStyles[tooltiptype][dir].trigger));
						}
						if ( configTltpStyles[tooltiptype][dir].deco ) {
							anime.remove(tooltipDOM.deco);
							let decoAnimOpts = {targets: tooltipDOM.deco};
							anime(Object.assign(decoAnimOpts, configTltpStyles[tooltiptype][dir].deco));
						}
					}
					function destroy() {
						tooltipDOM.trigger.removeEventListener('mouseenter', mouseenterFn);
						tooltipDOM.trigger.removeEventListener('mouseleave', mouseleaveFn);
						tooltipDOM.trigger.removeEventListener('touchstart', mouseenterFn);
						tooltipDOM.trigger.removeEventListener('touchend', mouseleaveFn);
					}
                })
	        },
	    });

	    elementorFrontend.hooks.addAction('frontend/element_ready/widget', function ($scope) {
	        elementorFrontend.elementsHandler.addHandler(Tooltip, {
	            $element: $scope
	        });
	    });
	});
})(jQuery, window.elementorFrontend);