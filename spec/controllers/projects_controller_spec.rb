require 'spec_helper'

describe ProjectsController do
	describe "get :show" do
		context "with project" do
			let!(:projects) { 2.times.map { create(:project) } }

			describe '#index' do
		    before { get :index }
		    
		    it { should respond_with(:success) }
		  
			  it 'should pick up items' do
			    collection = assigns(:projects) 
				  expect(collection).to have(2).items
				  expect(collection).to include(projects[0])
				  expect(collection).to include(projects[1])
				end
			end
		end
	end
end
