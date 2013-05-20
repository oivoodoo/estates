require 'spec_helper'

describe ProjectsController do
	context "on show projects page" do
		context "with existing post" do
			describe '#index' do
		    before { get :index }
		    
		    it { should respond_with(:success) }
		  end
		end
	end
end
